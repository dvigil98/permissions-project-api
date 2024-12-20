<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RolePermissionResource extends JsonResource
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
            'permission' => [
                'code' => $this->permission->code,
                'name' => $this->permission->name,
                'module' => $this->permission->module
            ],
            'active' => ($this->active) ? 1 : 0
        ];
    }
}
