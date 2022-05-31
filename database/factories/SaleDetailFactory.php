<?php

namespace Database\Factories;

use App\Models\SaleDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = SaleDetail::class;
    public function definition()
    {
        $pizzaPrices = [18000,28000,40000,19500,32500,53500,19500,32500,51500,19500,27500,36500,17000,27000,35000,17500,
            27500,37000,18000,28000,37000,18500,28500,46500,19000,32000,51000,18500,29000,37000,19000,28000,37000,16000,
            27000,35000,19000,32000,43000];
        return [
            'idSales'=> $this->faker->numberBetween(1,50),
            'idPlate'=> $this->faker->numberBetween(2,39),
            'quantity'=> $this->faker->numberBetween(1,4),
            'platePrice'=> $this->faker->randomElement($pizzaPrices),
            'description' => ''
        ];
    }
}
