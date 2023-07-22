<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Instance;
use App\Models\Ticket;

class InstanceController extends Controller
{
    public function show(Event $event)
    {
        $event_data = Event::where('id', $event->id)->get();
        $event_instances = Instance::where('event_id', $event->id)->get();

        $response = ['evento' => $event_data, 'fechas' => $event_instances];

        return response()->json($response);
    }

    public function show_tickets(Request $request, $instance_id){
        $tickets = Ticket::where('instance_id', $instance_id )->get();

        $response = ['tickets' => $tickets];

        return response()->json($response);
    }
}
