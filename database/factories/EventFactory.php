<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define como crear una instancia de Event. Se rellenan sus campos con
     * información generada con faker.
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

    /**
     * Faker no tiene un método para generar nombres de eventos.
     * Debo admitir que fue obtenido de ChatGPT y es la unica pieza
     * de código en la solución que generé con IA.
     */
    private function generateName(): string
    {
        $adjective = $this->faker->randomElement(['Amazing', 'Incredible', 'Fantastic', 'Spectacular', 'Unforgettable']);
        $noun = $this->faker->randomElement(['Concert', 'Festival', 'Gala', 'Expo', 'Conference']);
        $location = $this->faker->city;
        
        $event_name = "$adjective $noun in $location";
        return $event_name;
    }
}
