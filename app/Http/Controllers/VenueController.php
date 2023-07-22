<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\EventCollection;
use App\Models\Venue;

class VenueController extends Controller
{
    public function index()
    {
        return new EventCollection(Venue::all());
    }
}
