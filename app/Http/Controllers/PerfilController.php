<?php

namespace App\Http\Controllers;

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
        
        $acta_nacimiento=$perfil->files()->where('str_categoria_archivo', 'acta_nacimiento')->first();
        $comprobante_domicilio=$perfil->files()->where('str_categoria_archivo', 'comprobante_domicilio')->first();
        $ine=$perfil->files()->where('str_categoria_archivo', 'ine')->first();
        
        
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
        dd($request->all(), $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
