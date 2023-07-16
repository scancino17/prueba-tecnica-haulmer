<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;

use App\Http\Resources\CustomerResource;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Customer::all();
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $order)
    {
        $order->loadMissing('purchases.tickets');
        return new CustomerResource($order);
    }
}
