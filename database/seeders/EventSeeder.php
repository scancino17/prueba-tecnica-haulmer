<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Event;

class EventSeeder extends Seeder
{
    /**
     * Esto, ejecutandose "hacia abajo", genera toda la base de datos
     */
    public function run(): void
    {
        Event::factory()
            ->count(10)
            ->hasTickets(12)
            ->create();
    }
}
