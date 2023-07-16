<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            // Esto es un poco de trampa.
            /*'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'purchases' => */
            PurchaseResource::collection($this->whenLoaded('purchases'))
        ];
    }
}
