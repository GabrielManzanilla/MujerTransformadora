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
        $datosFiscales = auth()->user()->datosFiscales()->get();
        return view("solicitud.index", compact('datosFiscales'));
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
                'domicilios_json' => ['required', 'json'],

                //json de productos
                'productos_json' => ['required', 'json'],

                //json de redes sociales
                'redes_sociales_json' => ['required', 'json'],

                //documentos de registro
                'constancia_imss' => ['nullable', 'file', 'max:2048', 'mimes:pdf'], // Max 2MB, PDF only
                'constancia_impi' => ['nullable', 'file', 'max:2048', 'mimes:pdf'], // Max 2MB, PDF only
                'constancia_affy' => ['nullable', 'file', 'max:2048', 'mimes:pdf'], // Max 2MB, PDF only
                'constancia_sat' => ['nullable', 'file', 'max:2048', 'mimes:pdf'], // Max 2MB, PDF only
                'constancia_cif' => ['nullable', 'file', 'max:2048', 'mimes:pdf'], // Max 2MB, PDF only
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            dd($e->validator->errors()->all());
            return redirect()->back()->withErrors($e->validator);
        }

        //Regsitro de los datos fiscales
        // (Este se usara como base para el registro de los domicilios, productos y redes sociales)
        $user = auth()->user();
        $datosFiscales = $user->datosFiscales()->create([
            'str_regimen' => $request->regimen,
            'str_actividad_economica' => $request->actividad_economica,
            'str_nombre_comercial' => $request->nombre_comercial,
            'int_numero_empleados' => $request->numero_empleados,
            'str_razon_social' => $request->razon_social,
            'str_clave_imss' => $request->clave_imss,
            'str_clave_impi' => $request->clave_impi,
            'str_clave_affy' => $request->clave_affy,
            'str_clave_sat' => $request->clave_sat,
            'str_clave_cif' => $request->clave_cif,
        ]);


        //Decodificar el json de domicilios y subir sus datos correspondientes para llenar la tabla
        $domicilios_json = json_decode($request->domicilios_json, true);
        foreach ($domicilios_json as $domicilio) {
            $datosFiscales->domicilios()->create([
                'str_direccion' => $domicilio[0],
                'str_estado' => $domicilio[1],
                'str_municipio' => $domicilio[2],
                'str_localidad' => $domicilio[3],
            ]);
        }

        //Decodificar el json de productos y subir sus datos correspondientes para llenar la tabla
        $productos_json = json_decode($request->productos_json, true);
        foreach ($productos_json as $producto) {
            $datosFiscales->productos()->create([
                'str_nombre' => $producto[0],
                'str_descripcion' => $producto[1],
                'int_produccion_mensual' => $producto[2],
                'double_ventas_mensuales' => $producto[3],
                'double_ventas_anuales' => $producto[4],
            ]);
        }
        
        //Decodificar el json de redes sociales y subir sus datos correspondientes para llenar la tabla
        $redes_sociales_json = json_decode($request->redes_sociales_json, true);
        foreach ($redes_sociales_json as $red_social) {
            $datosFiscales->redesSociales()->create([
                'str_nombre_red_social' => $red_social[0],
                'str_perfil_red_social' => $red_social[1],
                'str_url_red_social' => $red_social[2],
            ]);
        }

        $file = app('App\Http\Controllers\FileController');
        $nombre_archivos = [
            'constancia_imss', 'constancia_impi', 'constancia_affy', 'constancia_sat', 'constancia_cif'
        ];
        foreach($nombre_archivos as $nombre) {
            $file->store($request, $nombre, $user, $datosFiscales->pk_dato_fiscal); 
            
        }
        return redirect()->route('solicitud.show', $datosFiscales->pk_dato_fiscal);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $datoFiscal = auth()->user()->datosFiscales()->findOrFail($id);

        return view("solicitud.show", compact('datoFiscal'));
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
