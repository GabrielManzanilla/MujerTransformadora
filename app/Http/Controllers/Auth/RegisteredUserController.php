<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        try{

            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'apellido_paterno' => ['required', 'string', 'max:255'],
                'apellido_materno' => ['required', 'string', 'max:255'],
                'fecha_nacimiento' => ['required', 'date'],
                'curp' => ['required', 'string', 'max:255'],
                'municipio_nacimiento' => ['required', 'string', 'max:255'],
                'estado_nacimiento' => ['required', 'string', 'max:255'],
                'sexo' => ['required', 'string'],
                'es_mayahablante' => ['required', 'boolean'],
            ]);
        }
        catch(\Illuminate\Validation\ValidationException $e){
            return redirect()->back()->withErrors($e->validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->perfil()->create([
            'str_nombre' => $request->name,
            'str_apellido_paterno' => $request->apellido_paterno,
            'str_apellido_materno' => $request->apellido_materno,
            'dt_fecha_nacimiento' => $request->fecha_nacimiento,
            'str_curp' => $request->curp,
            'str_municipio_nacimiento' => $request->municipio_nacimiento,
            'str_estado_nacimiento' => $request->estado_nacimiento,
            'str_sexo' => $request->sexo,
            'bool_es_mayahablante' => $request->es_mayahablante,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
