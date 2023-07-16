<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
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
            //'tickets' => TicketResource::collection($this->whenLoaded('tickets'))
        ];
    }
}
