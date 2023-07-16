<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Ticket;
use App\Http\Requests\StorePurchaseRequest;

use Carbon\Carbon;
use App\Http\Resources\PurchaseResource;

class PurchaseController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePurchaseRequest $request)
    {
        $ticket_id = $request->input('ticket_id');
        $time = Carbon::now()->toDateTimeString();
        
        $request->merge(['creation_time' => $time, 'payment_time' => $time]);
        $purchase = Purchase::create($request->except(['ticket_id']));
        
        $purchase_id = $purchase->id;
        Ticket::where('id', $ticket_id)->update(['purchase_id' => $purchase_id]);

        return new PurchaseResource($purchase);
    }
}
