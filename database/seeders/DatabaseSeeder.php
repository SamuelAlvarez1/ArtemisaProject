<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\roles;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        roles::create([
            'id' => '1',
            'nombre' => 'admin',
            'descripcion' => 'hola',
            'estado' => '1'
        ]);

        User::create([
            'apellidos' => 'admin',
            'name' => 'admin',
            'email' => 'admin@admin.admin',
            'estado' => '1',
            'idRol' => '1',
            'telefono' => '123123123',
            'password' => bcrypt('12345678'),
        ]);
    }
}
