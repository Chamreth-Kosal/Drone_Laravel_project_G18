<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DroneResource extends JsonResource
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
            'drone_id' => $this->drone_id,
            'type_of_drones' => $this->type_of_drones,
            'model' => $this->model,
            'battery' => $this->battery,
            'payload' => $this->payload,
            'serial_number' => $this->serial_number,
            'instructions' => $this->instructions,
            'price' => $this->price,
            'maps' => $this->maps,
            'location' => $this->locations
            
        ];
    }
}
