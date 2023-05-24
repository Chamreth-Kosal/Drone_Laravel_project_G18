<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowPlaneResource extends JsonResource
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
            'name' => $this->name,
            'area'  => $this->area,
            'datetime'  => $this->datetime,
            'duration'  => $this->duration,
            'status' => $this->status,
            'create_by_id' => $this->create_by_id,
        ];
    }
}
