<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthenticatedUserResource extends JsonResource
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
            'role' => [
                'id' => $this->role->id,
                'name' => $this->role->name
            ],
            'name' => $this->name,
            'email' => $this->email,
            'active' => ($this->active) ? 1 : 0
        ];
    }
}
