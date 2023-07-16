<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Adaptar la salida a convención JSON y limitar campos de salida.
     * También se encarga de limitar la información entregada dependiendo del
     * caso. Esto va junto porque ambas son manipulación de los datos entregados.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // Si es una petición get al endpoint event, entregar descripción.
        if ($request->route()->getName() === 'event.show') {
            return [
                'id' => $this->id,
                'name' => $this->name,
                'date' => $this->date,
                'description' => $this->description,
                'address' => $this->address
            ];
        }

        // Si no, omitir descripción.
        return [
            'id' => $this->id,
            'name' => $this->name,
            'date' => $this->date,
            'address' => $this->address
        ];
    }
}
