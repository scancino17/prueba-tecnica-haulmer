<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seedear la base de datos. Por lña forma en que se estructuran los factories,
     * solo es necesario ejecutar esto.
     */
    public function run(): void
    {
        $this->call([
            EventSeeder::class
        ]);
    }
}
