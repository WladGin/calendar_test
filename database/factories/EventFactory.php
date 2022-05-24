<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{

    protected $model = Event::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->firstName,
            'start_event' => $this->faker->dateTimeBetween('-10 days', '2 days'),
            'end_event' => $this->faker->dateTimeBetween('5 days', '10 days'),
        ];
    }
}
