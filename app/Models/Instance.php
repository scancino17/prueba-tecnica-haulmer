<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instance extends Model
{
    use HasFactory;

    protected $fillable = ['nro_tickets'];

    public function tickets() {
        return $this->hasMany(Ticket::class);
    }
    
    public function event() {
        return $this->belongsTo(Event::class);
    }

    public function venue() {
        return $this->hasOne(Venue::class);
    }
}
