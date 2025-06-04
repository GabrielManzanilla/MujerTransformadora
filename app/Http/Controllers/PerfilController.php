<?php

namespace App\Http\Controllers;

use App\Models\PerfilUsuario;
use Illuminate\Http\Request;
use App\Models\User;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
    public function store(Request $request)
    {
        //

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id = null)
    {
        if ($id) {
            $user = User::findOrFail($id);
        } else {
            $user = auth()->user();
        }

        $perfil = $user->perfil; // Accede a la relación como propiedad

        $acta_nacimiento = $perfil->files()->where('str_categoria_archivo', 'acta_nacimiento')->first();
        $comprobante_domicilio = $perfil->files()->where('str_categoria_archivo', 'comprobante_domicilio')->first();
        $ine = $perfil->files()->where('str_categoria_archivo', 'ine')->first();


        return view('perfil.show', [
            'user' => $user,
            'perfil' => $perfil,
            'status_acta_nacimiento' => $acta_nacimiento->str_status,
            'status_comprobante_domicilio' => $comprobante_domicilio->str_status,
            'status_ine' => $ine->str_status,
        ]);

    }


    /**
     * Show the form for editing the specified resource.
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $perfil = PerfilUsuario::findOrFail($id);
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

        return redirect()->route('perfil.show');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
