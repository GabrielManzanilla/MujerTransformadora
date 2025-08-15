<?php

namespace App\Http\Controllers;

use App\Models\PerfilUsuario;
use Illuminate\Http\Request;
use App\Models\User;

class PerfilController extends Controller
{
    /*
     * Muestra el listado de perfiles
     */
    public function index()
    {
        //
        auth()->user()->role === ('admin')
            && $users = User::with('perfil')->get();
        
        return view('perfil.index', compact('users'));
    }

    /*
     * Muestra un perfil en específico
     * @param string|null $id
     *  **El id puede ser nulo, ya que un administrador puede ver el perfil de otros con su id pero para ver su propio perfil se optiene el id automaticamente
     */
    public function show(string $id = null)
    {

        /* Obtiene el id del usuario correspondiente o el id del usuario logueado */
        $id
        ? $user = User::findOrFail($id)
        : $user = auth()->user();
        

        $perfil = $user->perfil; // Accede a la relación como propiedad


        //Obtiene los archivos (INE, acta de nacimiento, comprobante de domicilio)
        $acta_nacimiento = $perfil->files()->where('str_categoria_archivo', 'acta_nacimiento')->first();
        $comprobante_domicilio = $perfil->files()->where('str_categoria_archivo', 'comprobante_domicilio')->first();
        $ine = $perfil->files()->where('str_categoria_archivo', 'ine')->first();


        //regresa la informacion del usuario su perfil y la del estado de los archivos (si estan pendientes, en proceso o aprobados)
        return view('perfil.show', [
            'user' => $user,
            'perfil' => $perfil,
            'status_acta_nacimiento' => $acta_nacimiento->str_status,
            'status_comprobante_domicilio' => $comprobante_domicilio->str_status,
            'status_ine' => $ine->str_status,
        ]);

    }


    /**
     * Muestra el formulario para editar el perfil especificado.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $perfil = $user->perfil; // Accede a la relación como propiedad

        return view('auth.register', [
            'perfil' => $perfil,
            'method' => 'PUT',
        ]);
    }

    /**
     * Actualiza el perfil especificado.
     */
    public function update(Request $request, string $id)
    {
        //
        $perfil = PerfilUsuario::findOrFail($id);
        /*Verificacion de cumplimiento */
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'apellido_paterno' => ['required', 'string', 'max:255'],
            'apellido_materno' => ['required', 'string', 'max:255'],
            'fecha_nacimiento' => ['required', 'date'],
            'curp' => ['required', 'string', 'max:255'],
            'municipio_nacimiento' => ['required', 'string', 'max:255'],
            'estado_nacimiento' => ['required', 'string', 'max:255'],
            'sexo' => ['required', 'string'],
            'es_mayahablante' => ['required', 'boolean'],
            'telefono' => ['required', 'string', 'max:20'],
            'foto_perfil' => ['nullable', 'image', 'max:2048', 'mimes:jpg,jpeg,png'], // Max 2MB
            'ine' => ['nullable', 'file', 'max:2048', 'mimes:pdf'], // Max 2MB, PDF only
            'acta_nacimiento' => ['nullable', 'file', 'max:2048', 'mimes:pdf'], // Optional, Max 2MB, PDF only
            'comprobante_domicilio' => ['nullable', 'file', 'max:2048', 'mimes:pdf'], // Optional, Max 2MB, PDF only
        ]);
        $perfil->update([
            'str_nombre' => $request->name,
            'str_apellido_paterno' => $request->apellido_paterno,
            'str_apellido_materno' => $request->apellido_materno,
            'dt_fecha_nacimiento' => $request->fecha_nacimiento,
            'str_curp' => $request->curp,
            'str_municipio_nacimiento' => $request->municipio_nacimiento,
            'str_estado_nacimiento' => $request->estado_nacimiento,
            'str_sexo' => $request->sexo,
            'bool_es_mayahablante' => $request->es_mayahablante,
            'str_telefono' => $request->telefono,
        ]);

        // Actualiza los archivos del perfil, llama al FileController
        $file = app('App\Http\Controllers\FileController');
        ($request->hasFile('foto_perfil'))&& $file->update($request, 'foto_perfil', $perfil->user);
        ($request->hasFile('ine'))&&$file->update($request, 'ine', $perfil->user);
        ($request->hasFile('acta_nacimiento'))&&$file->update($request, 'acta_nacimiento', $perfil->user);
        ($request->hasFile('comprobante_domicilio'))&&$file->update($request, 'comprobante_domicilio', $perfil->user);

        return redirect()->route('perfil.show');

    }
}
