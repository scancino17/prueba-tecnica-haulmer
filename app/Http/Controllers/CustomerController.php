<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;

use App\Http\Resources\CustomerResource;

class CustomerController extends Controller
{
    /**
     * Mostrar las compras del usuario.
     */
    public function show(Customer $order)
    {
        // Cargar los tickets de las compras (y las compras).
        $order->loadMissing('purchases.tickets');
        return new CustomerResource($order);
    }
}
