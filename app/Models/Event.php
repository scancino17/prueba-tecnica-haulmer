<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    /* 
    Define la relación que este objeto tiene con el objeto Purchase.
    Un customer puede tener muchas purchases, 
    así que la relación es n a muchos.
    */
    public function tickets() {
        return $this->hasMany(Ticket::class);
    }

}
