<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if ($request->route()->getName() === 'event.show') {
            return [
                'id' => $this->id,
                'name' => $this->name,
                'date' => $this->date,
                'description' => $this->description,
                'address' => $this->address
            ];
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'date' => $this->date,
            'address' => $this->address
        ];
    }
}
