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
        $user = auth()->user()->role;
        if ($user === 'admin') {
            // If the user is an admin, show all fiscal data
            $datosFiscales = \App\Models\DatosFiscales::all();
            return view("solicitud.index", compact('datosFiscales'));
        } else {
            $datosFiscales = auth()->user()->datosFiscales()->get();
            return view("solicitud.index", compact('datosFiscales'));
        }
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
                'constancia_imss' => ['nullable', 'file', 'max:2048', 'mimes:pdf,jpg,jpeg,png'], // Max 2MB, PDF or Image
                'constancia_impi' => ['nullable', 'file', 'max:2048', 'mimes:pdf,jpg,jpeg,png'], // Max 2MB, PDF or Image
                'constancia_affy' => ['nullable', 'file', 'max:2048', 'mimes:pdf,jpg,jpeg,png'], // Max 2MB, PDF or Image
                'constancia_sat' => ['nullable', 'file', 'max:2048', 'mimes:pdf,jpg,jpeg,png'], // Max 2MB, PDF or Image
                'constancia_cif' => ['nullable', 'file', 'max:2048', 'mimes:pdf,jpg,jpeg,png'], // Max 2MB, PDF or Image
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
                'str_direccion' => $domicilio['direccion'],
                'str_estado' => $domicilio['estado'],
                'str_municipio' => $domicilio['municipio'],
                'str_localidad' => $domicilio['localidad'],
            ]);
        }

        //Decodificar el json de productos y subir sus datos correspondientes para llenar la tabla
        $productos_json = json_decode($request->productos_json, true);
        foreach ($productos_json as $producto) {
            $datosFiscales->productos()->create([
                'str_nombre' => $producto['nombre'],
                'str_descripcion' => $producto['descripcion'],
                'int_produccion_mensual' => $producto['produccion_mensual'],
                'double_ventas_mensuales' => $producto['ventas_mensuales'],
                'double_ventas_anuales' => $producto['ventas_anuales'],
            ]);
        }

        //Decodificar el json de redes sociales y subir sus datos correspondientes para llenar la tabla
        $redes_sociales_json = json_decode($request->redes_sociales_json, true);
        foreach ($redes_sociales_json as $red_social) {
            $datosFiscales->redesSociales()->create([
                'str_nombre_red_social' => $red_social['nombre_red_social'],
                'str_perfil_red_social' => $red_social['perfil_red_social'],
                'str_url_red_social' => $red_social['url_red_social'],
            ]);
        }

        $file = app('App\Http\Controllers\FileController');
        $nombre_archivos = [
            'constancia_imss',
            'constancia_impi',
            'constancia_affy',
            'constancia_sat',
            'constancia_cif'
        ];
        foreach ($nombre_archivos as $nombre) {
            $file->store($request, $nombre, $user, $datosFiscales);

        }
        return redirect()->route('solicitud.show', $datosFiscales->pk_dato_fiscal);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $datoFiscal = auth()->user()->datosFiscales()->findOrFail($id);

            // Check each file and provide a default status if not found
            $status_imss = $datoFiscal->files()->where('str_categoria_archivo', 'constancia_imss')->first();
            $status_impi = $datoFiscal->files()->where('str_categoria_archivo', 'constancia_impi')->first();
            $status_affy = $datoFiscal->files()->where('str_categoria_archivo', 'constancia_affy')->first();
            $status_sat = $datoFiscal->files()->where('str_categoria_archivo', 'constancia_sat')->first();
            $status_cif = $datoFiscal->files()->where('str_categoria_archivo', 'constancia_cif')->first();

            return view("solicitud.show", [
                'datoFiscal' => $datoFiscal,
                'status_imss' => $status_imss ? $status_imss->str_status : 'pendiente',
                'status_impi' => $status_impi ? $status_impi->str_status : 'pendiente',
                'status_affy' => $status_affy ? $status_affy->str_status : 'pendiente',
                'status_sat' => $status_sat ? $status_sat->str_status : 'pendiente',
                'status_cif' => $status_cif ? $status_cif->str_status : 'pendiente',
            ]);
        } catch (\Exception $e) {
            \Log::error('Error in show method: ' . $e->getMessage());
            return back()->with('error', 'Error al mostrar la solicitud: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Debug para ver el id recibido y la URL generada
        $updateRoute = route('solicitud.update', $id);

        //
        $datoFiscal = auth()->user()->datosFiscales()->findOrFail($id);

        $domicilios = json_encode($datoFiscal->domicilios->map(fn($domicilio) => [
            $domicilio->str_direccion,
            $domicilio->str_estado,
            $domicilio->str_municipio,
            $domicilio->str_localidad,
        ]));

        $productos = json_encode($datoFiscal->productos->map(fn($producto) => [
            $producto->str_nombre,
            $producto->str_descripcion,
            $producto->int_produccion_mensual,
            $producto->double_ventas_mensuales,
            $producto->double_ventas_anuales,
        ]));
        $redes_sociales = json_encode($datoFiscal->redesSociales->map(fn($red_social) => [
            $red_social->str_nombre_red_social,
            $red_social->str_perfil_red_social,
            $red_social->str_url_red_social,
        ]));
        return view("solicitud.form", compact('datoFiscal', 'domicilios', 'productos', 'redes_sociales'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            \Log::info('Updating solicitud with ID: ' . $id);

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
                'constancia_imss' => ['nullable', 'file', 'max:2048', 'mimes:pdf,jpg,jpeg,png'], // Max 2MB, PDF or Image
                'constancia_impi' => ['nullable', 'file', 'max:2048', 'mimes:pdf,jpg,jpeg,png'], // Max 2MB, PDF or Image
                'constancia_affy' => ['nullable', 'file', 'max:2048', 'mimes:pdf,jpg,jpeg,png'], // Max 2MB, PDF or Image
                'constancia_sat' => ['nullable', 'file', 'max:2048', 'mimes:pdf,jpg,jpeg,png'], // Max 2MB, PDF or Image
                'constancia_cif' => ['nullable', 'file', 'max:2048', 'mimes:pdf,jpg,jpeg,png'], // Max 2MB, PDF or Image
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation failed: ' . json_encode($e->validator->errors()->all()));
            return redirect()->back()->withErrors($e->validator)->withInput();
        }
        //Buscar el dato fiscal
        $datoFiscal = auth()->user()->datosFiscales()->findOrFail($id);
        //Actualizar los datos fiscales
        $datoFiscal->update([
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
        //Eliminar los domicilios existentes
        $datoFiscal->domicilios()->delete();
        //Decodificar el json de domicilios y subir sus datos correspondientes para llenar la tabla
        $domicilios_json = json_decode($request->domicilios_json, true);
        foreach ($domicilios_json as $domicilio) {
            $datoFiscal->domicilios()->create([
                'str_direccion' => $domicilio[0],
                'str_estado' => $domicilio[1],
                'str_municipio' => $domicilio[2],
                'str_localidad' => $domicilio[3],
            ]);
        }
        //Eliminar los productos existentes
        $datoFiscal->productos()->delete();
        //Decodificar el json de productos y subir sus datos correspondientes para llenar la tabla
        $productos_json = json_decode($request->productos_json, true);
        foreach ($productos_json as $producto) {
            $datoFiscal->productos()->create([
                'str_nombre' => $producto[0],
                'str_descripcion' => $producto[1],
                'int_produccion_mensual' => $producto[2],
                'double_ventas_mensuales' => $producto[3],
                'double_ventas_anuales' => $producto[4],
            ]);
        }
        //Eliminar las redes sociales existentes
        $datoFiscal->redesSociales()->delete();
        //Decodificar el json de redes sociales y subir sus datos correspondientes para llenar la tabla
        $redes_sociales_json = json_decode($request->redes_sociales_json, true);
        foreach ($redes_sociales_json as $red_social) {
            $datoFiscal->redesSociales()->create([
                'str_nombre_red_social' => $red_social[0],
                'str_perfil_red_social' => $red_social[1],
                'str_url_red_social' => $red_social[2],
            ]);
        }


        try {
            $file = app('App\Http\Controllers\FileController');
            $nombre_archivos = [
                'constancia_imss',
                'constancia_impi',
                'constancia_affy',
                'constancia_sat',
                'constancia_cif'
            ];
            foreach ($nombre_archivos as $nombre) {
                // Check if there's a file being uploaded
                if ($request->hasFile($nombre)) {
                    $file->update($request, $nombre, $datoFiscal->user, $datoFiscal);
                }
            }
        } catch (\Exception $e) {
            // Log the error and return a more helpful message
            \Log::error('Error updating files: ' . $e->getMessage());
            return back()->with('error', 'Error processing files: ' . $e->getMessage());
        }

        return redirect()->route('solicitud.show', $datoFiscal->pk_dato_fiscal);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
