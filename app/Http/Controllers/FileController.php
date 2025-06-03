<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function PHPUnit\Framework\isArray;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private function upload_file(Request $request, $nombre_archivo, $user, $solicitud_id = null){

        //comprueba si el archivo fue subido o lanza un error
        if(!$request->hasFile($nombre_archivo)) {
            return response()->json(['message' => 'No file uploaded'], 400);
        }
        else{
            //comprueba si el archivo es un array, en caso de que se suban varios archivos y toma el primer archivo
            $archivo = $request->file($nombre_archivo);
            if(is_array($archivo)) {
                $archivo = $archivo[0];
            } elseif ($archivo instanceof \Illuminate\Http\UploadedFile) {
                $archivo;
            }

            //si solo existe un id de usuario, se guarda en la carpeta del perfil del usuario
            //si existe un id de solicitud, se guarda en la carpeta del perfil del usuario y la solicitud
            $carpeta = $solicitud_id 
                ? "perfil/{$user->id}/solicitud/{$solicitud_id}"
                : "perfil/{$user->id}";

            $ruta_archivo = $archivo->storeAs($carpeta, "{$nombre_archivo}", 'local');
            
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
    public function store(Request $request, $nombre_archivo, $user, $solicitud_id = null)

    {   //obtiene la respuesta de la funcion upload_file 
        $response = $this->upload_file($request, $nombre_archivo, $user, $solicitud_id);

        //verifica si la respuesta es exitosa y obtiene el path del archivo
        if ($response->getStatusCode() === 201) {
            $responseData = json_decode($response->getContent());
            $filePath = $responseData->file_path;

            //guarda la relacion del archivo con el usuario
            $user->perfil->files()->create([
                'str_path_archivo' => $filePath,
                'str_categoria_archivo' => $nombre_archivo,
                'str_nombre_archivo' => basename($filePath),
            ]);
        }
        else {
            
            return $response; // Return the error response directly
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
