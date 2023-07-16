<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    /*
     * Estos son los campos que deben ser rellenados al momento de crear una compra.
     */
    protected $fillable = [
        'customer_id',
        'status',
        'creation_time',
        'payment_time',
    ];

    /*
    Aquí se define la relación de este objeto con Customer.
    Una Purchase sólo pertenece a un Customer y este sólo existe 
    para el Customer.
     */
    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    /*
    Aquí se define la relación de este objeto con Ticket.
    En una compra pueden haber sido comprado varios tickets.
     */
    public function tickets() {
        return $this->hasMany(Ticket::class);
    }

}
