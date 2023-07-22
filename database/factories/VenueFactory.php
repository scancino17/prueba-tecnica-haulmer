<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Venue>
 */
class VenueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $capacity = 15;

        return [
            'name' => $this->generateName(),
            'address' => $this->faker->address(),
            'capacity' => $capacity,
        ];
        
    }

    private function generateName(): string
    {
        $adjective = $this->faker->randomElement(['Amazing', 'Incredible', 'Fantastic', 'Spectacular', 'Unforgettable']);
        $venue_type = $this->faker->randomElement(['Theater', 'Arena', 'Stadium', 'Convention Center', 'Club', 'Amphitheater']);
        $location = $this->faker->city;
        
        $venue_name = "$adjective $venue_type in $location";
        return $venue_name;
    }
}
