<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    /**
     * Adaptar la salida a convención JSON y limitar campos de salida. 
     * Esto va junto porque ambas son manipulación de los datos entregados.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this.id,
            'type' => $this.type,
            'barcode' => $this.barcode,
            'seat' => $this.seat,
            'purchaseId' => $this.purchase_id,
            'eventId' => $this.event_id
        ];
    }
}
