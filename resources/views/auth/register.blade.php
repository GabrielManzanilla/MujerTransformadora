<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ isset($perfil)? route('perfil.update',$perfil->pk_perfil_id) : route('register') }}" class="overflow-y-auto px-1 "
                        enctype="multipart/form-data">
                        @csrf
                        @if($method === 'PUT')
                            @method('PUT')
                        @endif

                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                :value="old('str_nombre',$perfil->str_nombre??'')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Apellido Paterno -->
                        <div class="mt-4">
                            <x-input-label for="apellido_paterno" :value="__('Apellido Paterno')" />
                            <x-text-input id="apellido_paterno" class="block mt-1 w-full" type="text"
                                name="apellido_paterno" :value="old('str_apellido_paterno', $perfil->str_apellido_paterno??'')" required autofocus
                                autocomplete="apellido_paterno" />
                            <x-input-error :messages="$errors->get('apellido_paterno')" class="mt-2" />
                        </div>

                        <!-- Apellido Materno -->
                        <div class="mt-4">
                            <x-input-label for="apellido_materno" :value="__('Apellido Materno')" />
                            <x-text-input id="apellido_materno" class="block mt-1 w-full" type="text"
                                name="apellido_materno" :value="old('str_apellido_materno', $perfil->str_apellido_materno??'')" required autofocus
                                autocomplete="apellido_materno" />
                            <x-input-error :messages="$errors->get('apellido_materno')" class="mt-2" />
                        </div>
                        <!-- Fecha de Nacimiento -->
                        <div class="mt-4">
                            <x-input-label for="fecha_nacimiento" :value="__('Fecha de Nacimiento')" />
                            <x-text-input id="fecha_nacimiento" class="block mt-1 w-full" type="date"
                            name="fecha_nacimiento" :value="old('dt_fecha_nacimiento', isset($perfil->dt_fecha_nacimiento) ? date('Y-m-d', strtotime($perfil->dt_fecha_nacimiento)) : '')" required autofocus
                            autocomplete="fecha_nacimiento" />
                            <x-input-error :messages="$errors->get('fecha_nacimiento')" class="mt-2" />
                        </div>
                        <!-- CURP -->
                        <div class="mt-4">
                            <x-input-label for="curp" :value="__('CURP')" />
                            <x-text-input id="curp" class="block mt-1
                            w-full" type="text" name="curp" :value="old('str_curp', $perfil->str_curp??'')" required autofocus
                                autocomplete="curp" />
                            <x-input-error :messages="$errors->get('curp')" class="mt-2" />
                        </div>

                        <!-- Lugar Nacimiento -->
                        <div class="flex">
                            <div class="mt-4 w-1/2">
                                <x-input-label for="municipio_nacimiento" :value="__('Municipio de Nacimiento')" />
                                <x-text-input id="municipio_nacimiento" class="block mt-1 w-full" type="text"
                                    name="municipio_nacimiento" :value="old('str_municipio_nacimiento', $perfil->str_municipio_nacimiento??'')" required autofocus
                                    autocomplete="municipio_nacimiento" />
                                <x-input-error :messages="$errors->get('municipio_nacimiento')" class="mt-2" />
                            </div>

                            <div class="mt-4 w-1/2 ms-4">
                                <x-input-label for="estado_nacimiento" :value="__('Estado de Nacimiento')" />
                                <x-text-input id="estado_nacimiento" class="block mt-1 w-full" type="text"
                                    name="estado_nacimiento" :value="old('str_estado_nacimiento', $perfil->str_estado_nacimiento??'')" required autofocus
                                    autocomplete="estado_nacimiento" />
                                <x-input-error :messages="$errors->get('estado_nacimiento')" class="mt-2" />
                            </div>

                        </div>

                        <!-- Sexo -->
                        <div class="mt-4">
                            <x-input-label for="sexo" :value="__('Sexo')" />
                            <select id="sexo" name="sexo" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-secondary focus:ring focus:ring-secondary focus:ring-opacity-50">
                                <option value="Masculino" {{ old('str_sexo', $perfil->str_sexo??'') == 'Masculino' ? 'selected' : '' }}>
                                    Masculino</option>
                                <option value="Femenino" {{ old('str_sexo', $perfil->str_sexo??'') == 'Femenino' ? 'selected' : '' }}>
                                    Femenino</option>
                            </select>
                            <x-input-error :messages="$errors->get('sexo')" class="mt-2" />
                        </div>

                        <!-- EsMayahablante? -->
                        <div class="mt-4">
                            <input type="hidden" name="es_mayahablante" value="0">
                            <div class="flex gap-1">
                                <input id="es_mayahablante" type="checkbox" name="es_mayahablante" value="1"
                                {{ old('bool_es_mayahablante', $perfil->bool_es_mayahablante??'')==1 ? 'checked' : '' }} class="rounded border-gray-300 text-secondary shadow-sm focus:border-secondary focus:ring focus:ring-secondary focus:ring-opacity-50">
                                <x-input-label for="es_mayahablante" :value="__('¿Es mayahablante?')" />
                            </div>
                            <x-input-error :messages="$errors->get('es_mayahablante')" class="mt-2" />
                        </div>

                        <!-- Foto perfil -->
                        <div class="mt-4">
                            <x-input-label for="foto_perfil" :value="__('Foto de Perfil')" />
                            <x-input-file id="foto_perfil" accept="image/*" />
                            <x-input-error :messages="$errors->get('foto_perfil')" class="mt-2" />
                        </div>

                        <!-- INE -->
                        <div class="mt-4">
                            <x-input-label for="ine" :value="__('INE')" />
                            <x-input-file id="ine" accept="pdf/*"/>
                            <x-input-error :messages="$errors->get('ine')" class="mt-2" />
                        </div>

                        <!--Acta Nacimiento -->
                        <div class="mt-4">
                            <x-input-label for="acta_nacimiento" :value="__('Acta de Nacimiento')" />
                            <x-input-file id="acta_nacimiento" accept="pdf/*"/>
                            <x-input-error :messages="$errors->get('acta_nacimiento')" class="mt-2" />
                        </div>

                        <!-- Comprobante Domicilio -->
                        <div class="mt-4">
                            <x-input-label for="comprobante_domicilio" :value="__('Comprobante de Domicilio')" />
                            <x-input-file id="comprobante_domicilio" accept="pdf/*"/>
                            <x-input-error :messages="$errors->get('comprobante_domicilio')" class="mt-2" />
                        </div>

                        <!-- Teléfono -->
                        <div class="mt-4">
                            <x-input-label for="telefono" :value="__('Teléfono')" />
                            <x-text-input id="telefono" class="block mt-1 w-full" type="tel" name="telefono"
                                :value="old('str_telefono', $perfil->str_telefono??'')" required autocomplete="tel" />
                            <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
                        </div>

                        @guest
                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                :value="old('email')" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Password')" />

                            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                                required autocomplete="new-password" />

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                name="password_confirmation" required autocomplete="new-password" />

                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                href="{{ route('login') }}">
                                {{ __('Already registered?') }}
                            </a>

                            <x-primary-button class="ms-4">
                                {{ __('Register') }}
                            </x-primary-button>
                            
                        </div>
                        @endguest
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="mt-4">
                                {{ __('Guardar Perfil') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>