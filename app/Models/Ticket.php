<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    /*
    Aquí se define la relación de este objeto con Purchase.
    Una Ticket sólo pertenece a un Purchase.
     */
    public function purchase() {
        return $this->belongsTo(Purchase::class);
    }

    /*
    Aquí se define la relación de este objeto con Event.
    Una Ticket sólo pertenece a un Event, y este sólo existe 
    para el Event.
     */
    public function event() {
        return $this->belongsTo(Event::class);
    }

}
