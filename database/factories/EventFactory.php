<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->generateName(),
            'date' => $this->faker->dateTimeThisDecade(),
            'description' => $this->faker->paragraph(3, true),
            'address' => $this->faker->address(),
        ];
    }

    private function generateName(): string
    {
        $adjective = $this->faker->randomElement(['Amazing', 'Incredible', 'Fantastic', 'Spectacular', 'Unforgettable']);
        $noun = $this->faker->randomElement(['Concert', 'Festival', 'Gala', 'Expo', 'Conference']);
        $location = $this->faker->city;
        
        $event_name = "$adjective $noun in $location";
        return $event_name;
    }
}
