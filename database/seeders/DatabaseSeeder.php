<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\customer;
use App\Models\Event;
use App\Models\Plate;
use App\Models\bookingState;
use Database\Factories\CustomerFactory;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Rol;
use App\Models\Category;
use BookingsStates;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    public function run()
    {
        Rol::create([
            'id' => '1',
            'name' => 'Administrador',
            'description' => 'Rol por defecto',
            'state' => '1'
        ]);
        Rol::create([
            'id' => '2',
            'name' => 'Empelado',
            'description' => 'Rol por defecto',
            'state' => '1'
        ]);
        User::create([
            'last_name' => 'Valencia',
            'name' => 'Santiago',
            'email' => 'a@a.a',
            'state' => '1',
            'idRol' => '1',
            'phone' => '3002004040',
            'lastlog' => date('Y-m-d H:i:s'),
            'password' => bcrypt('12345678'),
        ]);
        Customer::factory(50)->create();
        Event::factory(20)->create();


        $categories = ['Papas', 'Pizzas', 'Arroz'];
        $states = ['Cancelada', 'En proceso', 'Aprobada'];
        foreach ($categories as $value) {
            Category::create([
                'name' => $value,
                'idUser' => '1',
                'state' => '1',
            ]);
        }

        foreach ($states as $value) {
            bookingState::create([
                'name' => $value
            ]);
        }

        Plate::create([
            'id' => 1,
            'name' => 'Platillo Personalizado',
            'price' => '0',
            'state' => '1',
        ]);
        Plate::create([
            'id' => 2,
            'name' => 'pizza hawaiana',
            'price' => '1500',
            'state' => '1',
            'idCategory' => '1',
        ]);
    }
}
