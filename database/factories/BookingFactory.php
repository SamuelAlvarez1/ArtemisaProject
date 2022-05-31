<?php

namespace Database\Factories;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Booking::class;
    public function definition()
    {
        return [
            'idCustomer'=> $this->faker->numberBetween(1,50),
            'idUser'=> $this->faker->numberBetween(1,10),
            'idEvent'=> $this->faker->numberBetween(1,20),
            'amount_people'=> $this->faker->numberBetween(1,79),
            'idState'=> $this->faker->numberBetween(1,3),
            'start_date'=> $this->faker->dateTimeBetween('2022-01-01 1:00:00', '2022-12-31 1:00:00'),
            'created_at'=> $this->faker->dateTimeBetween('2022-01-01 1:00:00', '2022-12-31 1:00:00')
        ];
    }
}
