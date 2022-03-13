<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Event::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'decorationPrice' => $this->faker->randomNumber(7),
            'entryPrice' => $this->faker->randomNumber(4),
            'state' => $this->faker->boolean,
            'startDate' => $this->faker->date('Y-m-d'),
            'endDate' => $this->faker->date('Y-m-d')
        ];
    }
}
