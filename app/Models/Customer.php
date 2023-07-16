<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    /* 
    Define la relación que este objeto tiene con el objeto Purchase.
    Un customer puede tener muchas purchases, así que la relación es n a muchos.
    */
    public function purchases() {
        return $this->hasMany(Purchase::class);
    }

    /* 
    Define la relación que este objeto tiene con el objeto Tickets.
    Un customer puede tener muchas tickets a través de muchos purchases,
    así que la relación es n a muchos. 
    */
    public function tickets(){
        return $this->hasManyThrough(Ticket::class, Purchase::class);
    }

}
