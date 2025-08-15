<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use function PHPUnit\Framework\isArray;

class FileController extends Controller
{
    /*
    Esta funcion se encarga de manejar la subida de archivos
    @param Request $request : es el contenido de la solicitud HTTP
    @param string $nombre_archivo : es el nombre del archivo que se esta subiendo (ejemplo: acta_nacimiento, curp, etc)
    @param User $user : es el usuario que esta logueado
    @param Solicitud|null $solicitud : es el id de la solicitud
        *Este dato es opcional y puede ser nulo, porque puede que al archivo a subir no se le asocie una solicitud solo a un usuario
    @return JsonResponse|null
     */
    private function upload_file(Request $request, $nombre_archivo, $user, $solicitud = null)
    {

        /* Comprueba si se esta mandando un archivo
         */
        if (!$request->hasFile($nombre_archivo)) {
            return null;
        } else {

            //comprueba si el archivo es un array y toma el primer archivo
            $archivo = $request->file($nombre_archivo);
            if (is_array($archivo)) {
                $archivo = $archivo[0];
            } elseif ($archivo instanceof \Illuminate\Http\UploadedFile) {
                $archivo;
            }

            //si existe un id de solicitud, se guarda en la carpeta de la solicitud
            $carpeta = $solicitud
                ? "usuarios/{$user->id}/solicitud/{$solicitud->pk_dato_fiscal}/documentos"
                : "usuarios/{$user->id}/documentos";

            /*Obtiene la extension original del archivo y lo guarda con el nombre (tipo) de archivo y la extension original
            (ejemplo: acta_nacimiento.pdf)
            */
            $extension = $archivo->getClientOriginalExtension();
            $filename = "{$nombre_archivo}.{$extension}";
            $ruta_archivo = $archivo->storeAs($carpeta, $filename, 'local');

            return response()->json([
                'message' => 'File uploaded successfully',
                'file_path' => $ruta_archivo
            ], 201);
        }


    }

    /*
     * Almacenamieto de la ruta (path) del archivo en la base de datos
     * @param Request $request : es el contenido de la solicitud HTTP
     * @param string $nombre_archivo : es el nombre del archivo que se esta subiendo (ejemplo: acta_nacimiento, curp, etc)
     * @param User $user : es el usuario que esta logueado
     * @param Solicitud|null $solicitud : es el id de la solicitud
     */
    public function store(Request $request, $nombre_archivo, $user, $solicitud = null)
    {
        try {
            // Salir si no se ha subido ningún archivo
            if (!$request->hasFile($nombre_archivo)) {
                return;
            }

            // llamado a la funcion upload_file para almacenar el archivo
            $response = $this->upload_file($request, $nombre_archivo, $user, $solicitud);

            // Verificar si la respuesta es exitosa y obtener la ruta del archivo
            if ($response->getStatusCode() === 201) {
                $responseData = json_decode($response->getContent());
                $filePath = $responseData->file_path;

                // Almacena la ruta del archivo en la base de datos, asociandola a la solicitud o al perfil del usuario
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

    /*
     * Mostrar el archivo especificado 
     * En el HTML se utiliza la propiedad blank para que se abra en una pestaña nueva
     * @param string $propietario : es el propietario del archivo (perfil o dato fiscal)
     * @param string $tipo_archivo : es el tipo de archivo que se esta mostrando
     */
    public function show($propietario, $tipo_archivo)
    {
        /*
         * Si el propietario es un perfil, se obtiene el perfil del usuario autenticado, sino se obtiene el dato fiscal correspondiente
         */
        $origin = $propietario == "perfil"
            ? auth()->user()->perfil
            : auth()->user()->datosFiscales
                ->where('pk_dato_fiscal', $propietario)
                ->firstOrFail();

        /* Obtiene el path del archivo con la relacion files, ya sea del perfil o del dato fiscal */
        $archivo = $origin->files()
            ->where('str_categoria_archivo', $tipo_archivo)
            ->first();

        /* Obtiene el archivo del disco*/
        $path = Storage::disk('local')->path(
            $archivo->str_path_archivo
        );

        return response()->file($path);

    }


    /*
     * Actualizacion o cambio de un archivo
     *  @param Request $request
     *  @param string $nombre_archivo
     *  @param User $user
     *  @param Solicitud|null $solicitud
     */
    public function update(Request $request, $nombre_archivo, $user, $solicitud = null)
    {
        $origin = $solicitud
            ? $solicitud // Si es una solicitud, se utiliza directamente el id de la solicitud, sino utiliza el id del usuario
            : $user->perfil;

        /*
         * Obtiene el path del archivo correspondiente 
         */
        $archivo = $origin->files()
            ->where('str_categoria_archivo', $nombre_archivo)
            ->first();

        // Elimina el archivo utilizando el path
        if ($archivo) {
            Storage::disk('local')->delete($archivo->str_path_archivo);
            $archivo->delete();
        }

        // Almacena el nuevo archivo
        $this->store($request, $nombre_archivo, $user, $solicitud);

    }

}
