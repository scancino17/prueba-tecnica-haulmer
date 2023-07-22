<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    public function venue() {
        return $this->belongsTo(Venue::class);
    }

    public function ticket() {
        return $this->belongsTo(Ticket::class);
    }
}
