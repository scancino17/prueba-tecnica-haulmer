<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Purchase>
 */
class PurchaseFactory extends Factory
{
    /**
     * Define como crear una instancia de Purchase. Se rellenan sus campos con
     * información generada con faker. Acá también se definieron los posibles 
     * estados y se intenta que la informción generada tenga *algo* de sentido.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = $this->faker->randomElement(['creado', 'pagado', 'cancelado']);

        return [
            'customer_id' => Customer::factory(),
            'status' => $status,
            'creation_time' => $this->faker->dateTimeThisDecade(),
            'payment_time' => $status == 'pagado' ? $this->faker->dateTimeThisDecade() : NULL,
        ];
    }
}
