<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseResource extends JsonResource
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
            'id' => $this->id,
            'status' => $this->status,
            'creationTime' => $this->creation_time,
            'paymentTime' => $this->payment_time,
            'tickets' => $this->tickets
        ];
    }
}
