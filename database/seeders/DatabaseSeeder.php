<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::create([
            'id' => (string) Str::uuid(),
            'role' => 'admin',
            'email' => 'admin@demo.com',
            'password' => bcrypt('password'), // Cambia la contraseña si lo deseas
        ]);

        $user->perfil()->create([
            'str_nombre' => 'Admin',
            'str_apellido_paterno' => 'Demo',
            'str_apellido_materno' => 'User',
            'dt_fecha_nacimiento' =>'02/12/2002',
            'str_curp' => 'MX000X000X000X000',
            'str_municipio_nacimiento' => 'merida',
            'str_estado_nacimiento' => 'yucatan',
            'str_sexo'=>'masculino',
            'bool_es_mayahablante' => '0',
            'str_telefono' => '9999000999'	
            
        ]);
    }

}
