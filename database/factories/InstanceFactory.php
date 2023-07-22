<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Event;
use App\Models\Venue;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Instance>
 */
class InstanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $venue = Venue::inRandomOrder()->first();

        return [
            //'event_id' => Event::inRandomOrder()->first()->id,
            'venue_id' => $venue->id,
            'date' => $this->faker->dateTimeThisDecade(),
            'nro_tickets' => $venue->capacity
        ];
    }
}
