<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;

use App\Http\Resources\EventResource;
use App\Http\Resources\EventCollection;

class EventController extends Controller
{
    /**
     * Mostrar la lista de eventos en /events
     */
    public function index()
    {
        return new EventCollection(Event::all());
    }

    /**
     * Mostrar el evento específico /event/{id}
     */
    public function show(Event $event)
    {
        return new EventResource($event);
    }
}
