<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use function PHPUnit\Framework\isArray;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private function upload_file(Request $request, $nombre_archivo, $user, $solicitud = null)
    {

        //comprueba si el archivo fue subido o lanza un error
        if (!$request->hasFile($nombre_archivo)) {
            return response()->json(['message' => 'No file uploaded'], 400);
        } else {
            //comprueba si el archivo es un array, en caso de que se suban varios archivos y toma el primer archivo
            $archivo = $request->file($nombre_archivo);
            if (is_array($archivo)) {
                $archivo = $archivo[0];
            } elseif ($archivo instanceof \Illuminate\Http\UploadedFile) {
                $archivo;
            }

            //si solo existe un id de usuario, se guarda en la carpeta del perfil del usuario
            //si existe un id de solicitud, se guarda en la carpeta del perfil del usuario y la solicitud
            $carpeta = $solicitud
                ? "usuarios/{$user->id}/solicitud/{$solicitud->pk_dato_fiscal}/documentos"
                : "usuarios/{$user->id}/documentos";

            $extension = $archivo->getClientOriginalExtension();
            $filename = "{$nombre_archivo}.{$extension}";
            $ruta_archivo = $archivo->storeAs($carpeta, $filename, 'local');

            return response()->json([
                'message' => 'File uploaded successfully',
                'file_path' => $ruta_archivo
            ], 201);
        }


    }


    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $nombre_archivo, $user, $solicitud = null)
    {
        try {
            // Skip if no file was uploaded
            if (!$request->hasFile($nombre_archivo)) {
                return;
            }

            // Get the response from the upload_file function
            $response = $this->upload_file($request, $nombre_archivo, $user, $solicitud);

            // Verify if the response is successful and get the file path
            if ($response->getStatusCode() === 201) {
                $responseData = json_decode($response->getContent());
                $filePath = $responseData->file_path;

                // Save the file relationship with the user or solicitud
                if ($solicitud) {
                    $solicitud->files()->create([
                        'str_path_archivo' => $filePath,
                        'str_categoria_archivo' => $nombre_archivo,
                        'str_nombre_archivo' => basename($filePath),
                        'str_status' => 'pendiente', // Default status
                    ]);
                } else {
                    $user->perfil->files()->create([
                        'str_path_archivo' => $filePath,
                        'str_categoria_archivo' => $nombre_archivo,
                        'str_nombre_archivo' => basename($filePath),
                        'str_status' => 'pendiente', // Default status
                    ]);
                }
            } else {
                \Log::warning("File upload failed for {$nombre_archivo}: " . $response->getContent());
                return $response; // Return the error response directly
            }
        } catch (\Exception $e) {
            \Log::error("Exception in store method: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($propietario, $tipo_archivo)
    {
        $origin = $propietario == "perfil"
            ? auth()->user()->perfil
            : auth()->user()->datosFiscales
                ->where('pk_dato_fiscal', $propietario)
                ->firstOrFail();

        $archivo = $origin->files()
            ->where('str_categoria_archivo', $tipo_archivo)
            ->first();

        $path = Storage::disk('local')->path(
            $archivo->str_path_archivo
        );

        return response()->file($path);

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $nombre_archivo, $user, $solicitud = null)
    {
        $origin = $solicitud
            ? $solicitud // Use the solicitud directly since it's already been fetched
            : $user->perfil;

        $archivo = $origin->files()
            ->where('str_categoria_archivo', $nombre_archivo)
            ->first();

        // Only delete if the file exists
        if ($archivo) {
            Storage::disk('local')->delete($archivo->str_path_archivo);
            $archivo->delete();
        }

        // Store the new file
        $this->store($request, $nombre_archivo, $user, $solicitud);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
