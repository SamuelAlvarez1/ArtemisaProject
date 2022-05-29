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
            'name' => 'Empleado',
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

        $pizzaNames = ['Pizza Delicia ranchera' , 'Pizza Merry', 'Pizza Artemisa', 'Pizza Tierna y dulce', 'Pizza Hawaiana',
            'Pizza Napolitana', 'Pizza Peperoni', 'Pizza Pollo y champiñones','Pizza de mi tierra','Pizza desgranada',
            'Pizza Pollo y tocineta','Pizza Jamon y queso','Pizza Vegetariana'];
        $pizzaSizes = ['pequeña', 'mediana', 'grande'];
        $pizzaPrices = [18000,28000,40000,19500,32500,53500,19500,32500,51500,19500,27500,36500,17000,27000,35000,17500,
            27500,37000,18000,28000,37000,18500,28500,46500,19000,32000,51000,18500,29000,37000,19000,28000,37000,16000,
            27000,35000,19000,32000,43000];
        $pizzasI =0;
        for($i=0;$i<sizeof($pizzaNames);$i++){
            for ($j = 0; $j < sizeof($pizzaSizes); $j++) {
                Plate::create([
                    'name' => $pizzaNames[$i] . ' ' . $pizzaSizes[$j],
                    'price' => $pizzaPrices[$pizzasI],
                    'state' => '1',
                    'idCategory' => '2',
                    'image' => '',
                    'created_at' => date('Y-m-d H:m:i'),
                    'updated_at' => date('Y-m-d H:m:i'),
                ]);
                $pizzasI++;
            }
        }
    }
}
