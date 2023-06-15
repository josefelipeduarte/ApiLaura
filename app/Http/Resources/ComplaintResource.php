<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ComplaintResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user' => [
                'id' => $this->user?->id,
                'name' => $this->user?->name,
            ],
            'organization' => [
                'id' => $this->organization->id,
                'name' => $this->organization->name,
            ],
            'school' => [
                'id' => $this->school->id,
                'name' => $this->school->name,
            ],
            'description' => $this->description,
            'classification' => $this->classification,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
