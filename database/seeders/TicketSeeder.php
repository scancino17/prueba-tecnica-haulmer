<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Ticket;
use App\Models\Instance;
use App\Models\Seat;

use Faker\Factory as Faker;

class TicketSeeder extends Seeder
{
    /**
     * Crea tickets para cada asiento de un "Venue" que tenga un evento asociado.
     */
    public function run(): void
    {
        $instances = Instance::get();

        foreach($instances as $instance){
            $seats = Seat::where('venue_id', $instance->venue_id)->get();
            $this->generate_tickets($instance, $seats);
        }
        
    }

    /*
        Se encarga de generar los tickets para cada asiento indicando
        la instancia del evento y el id del asiento.
    */
    function generate_tickets(Instance $instance,  $seats){
        $faker = Faker::create();
        $type = $faker->randomElement(['general', 'especial', 'vip']);

        foreach($seats as $seat){
            $ticket = new Ticket;
            $ticket->instance_id = $instance->id;
            $ticket->seat_id = $seat->id;
            $ticket->type = $type;
            $ticket->barcode = $faker->ean13();
            $ticket->save();
        }
    }
}
