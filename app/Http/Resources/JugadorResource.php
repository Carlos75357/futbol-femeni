<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JugadorResource extends JsonResource
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
            'nom' => $this->nom,
            'equip' => $this->Equip->nom,
            'edat' => $this->edat,
            'posicio' => $this->posicio,
            'dorsal' => $this->dorsal,
            'links' => [
                'self' => route('jugadores.show', $this->id),
            ],
        ];
    }
}
