<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $pizzaPrices = [18000,28000,40000,19500,32500,53500,19500,32500,51500,19500,27500,36500,17000,27000,35000,17500,
            27500,37000,18000,28000,37000,18500,28500,46500,19000,32000,51000,18500,29000,37000,19000,28000,37000,16000,
            27000,35000,19000,32000,43000];
        return [
            'idCustomers' => $this->faker->numberBetween(1,50),
            'idUser' => $this->faker->numberBetween(1,10),
            'finalPrice' => ($this->faker->randomElement($pizzaPrices))*2,
            'state' => $this->faker->boolean,
            'created_at'=> $this->faker->dateTimeBetween('2022-01-01 1:00:00', '2022-12-31 1:00:00')
        ];
    }
}
