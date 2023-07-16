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
     * Crear una nueva compra en el sistema con POST en /purchase
     */
    public function store(StorePurchaseRequest $request)
    {
        // obtener el id del ticket para después actualizar su dueño
        $ticket_id = $request->input('ticket_id');

        // obtener la fecha del sistema y concatenarlo al request.
        $time = Carbon::now()->toDateTimeString();
        $request->merge(['creation_time' => $time, 'payment_time' => $time]);

        // Crea la compra entregando la información pero excluyendo el ticket_id
        $purchase = Purchase::create($request->except(['ticket_id']));
        
        // Obtiene el id de la nueva compra para luego asignarlo al ticket comprado.
        $purchase_id = $purchase->id;
        Ticket::where('id', $ticket_id)->update(['purchase_id' => $purchase_id]);

        // Responder con compra creada.
        return new PurchaseResource($purchase);
    }
}
