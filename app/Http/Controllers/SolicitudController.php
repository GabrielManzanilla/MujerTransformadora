<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("solicitud.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("solicitud.form");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            dd($request->all());
            $request->validate([

                //datos fiscales
                'regimen' => ['required', 'string', 'max:255'],
                'actividad_economica' => ['required', 'string', 'max:255'],
                'nombre_comercial' => ['required', 'string', 'max:255'],
                'numero_empleados' => ['required', 'integer', 'min:1'],
                'razon_social' => ['required', 'string', 'max:255'],
                'clave_imss' => ['required', 'string', 'max:255'],
                'clave_impi' => ['required', 'string', 'max:255'],
                'clave_affy' => ['required', 'string', 'max:255'],
                'clave_sat' => ['required', 'string', 'max:255'],
                'clave_cif' => ['required', 'string', 'max:255'],

                //json domicilios
                'domicilios' => ['required', 'json'],

                //json de productos
                'productos' => ['required', 'json'],

                //json de redes sociales
                'redes_sociales' => ['required', 'json'],

                //documentos de registro
                'constancia_imss' => ['required', 'file', 'max:2048', 'mimes:pdf'], // Max 2MB, PDF only
                'constancia_impi' => ['required', 'file', 'max:2048', 'mimes:pdf'], // Max 2MB, PDF only
                'constancia_affy' => ['required', 'file', 'max:2048', 'mimes:pdf'], // Max 2MB, PDF only
                'constancia_sat' => ['required', 'file', 'max:2048', 'mimes:pdf'], // Max 2MB, PDF only
                'constancia_cif' => ['required', 'file', 'max:2048', 'mimes:pdf'], // Max 2MB, PDF only
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        }

        //Modelos para guardar los datos
        $user = auth()->user();

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
