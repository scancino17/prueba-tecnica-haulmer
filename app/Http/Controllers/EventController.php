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
     * Display a listing of the resource.
     */
    public function index()
    {
        return new EventCollection(Event::all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return new EventResource($event);
    }
}
