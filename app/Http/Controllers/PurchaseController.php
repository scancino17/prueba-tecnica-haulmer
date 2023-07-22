<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Ticket;
use App\Models\Instance;

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
        $instance = Instance::where('id', $request->input('event_instance_id'))->first();

        if($instance->nro_tickets < $request->input('nro_tickets')){
            $response = ['mensaje' => 'El stock actual de las entradas no es suficiente para completar su pedido.'];

            return response($response);
        }
        else{
            $seats_id = $request->input('seats_id');

            foreach($seats_id as $seat){
                $this->register_purchase($request->input('customer_id'), $instance->id, 
                    $seat, $request->input('status'));
            }

            $old_nro_tickets = $instance->nro_tickets;

            $new_nro_tickets = $old_nro_tickets - $request->input('nro_tickets');
            $instance->update(['nro_tickets' => $new_nro_tickets]);
        }

        return response('El pedido se ha registrado correctamente.');

        /*
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
        */
    }

    function register_purchase($customer_id, $instance_id, $seat_id, $status){
        $ticket = Ticket::where('instance_id', $instance_id)->where('seat_id', $seat_id)->first();

        $time = Carbon::now()->toDateTimeString();

        $purchase = new Purchase;
        $purchase->customer_id = $customer_id;
        $purchase->ticket_id = $ticket->id;
        $purchase->status = $status;
        $purchase->creation_time = $time;
        $purchase->payment_time = $time;
        $purchase->save();
    }
}
