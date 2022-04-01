<?php

namespace Database\Seeders;

use App\Models\customer;
use App\Models\Event;
use App\Models\Plate;
use Database\Factories\CustomerFactory;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Rol;
use App\Models\Category;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    public function run()
    {
        // \App\Models\User::factory(10)->create();

        Rol::create([
            'id' => '1',
            'name' => 'Administrador',
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
            'password' => bcrypt('12345678'),
        ]);
        Customer::factory(50)->create();
        Event::factory(20)->create();


        $categories = ['Papas', 'Pizzas', 'Arroz'];
        foreach ($categories as $value) {
            Category::create([
                'name' => $value,
            ]);
        }

        Plate::create([
            'name' => 'pizza hawaiana',
            'basePrice' => '1500',
            'state' => '1',
            'idCategory' => '1',
        ]);
    }
}
