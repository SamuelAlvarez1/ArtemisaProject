<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Customer::class;
    public function definition()
    {
        return [
            'document' => $this->faker->randomNumber(8),
            'name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'phoneNumber' => $this->faker-> phoneNumber(),
            'state' => $this->faker-> boolean,
        ];
    }
}
