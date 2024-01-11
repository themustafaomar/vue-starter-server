<?php

namespace App\Http\Resources;

use App\Enums\UserStatus;
use App\Enums\UserIsActive;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            // 'email_verified_at' => $this->email_verified_at,
            'avatar' => $this->getFirstMediaUrl('avatar', 'thumb'),
            'status' => UserStatus::from($this->status)->getAll(),
            'created' => $this->created_at->diffForHumans(),
            'role' => new RoleResource($this->whenLoaded('roles', function () {
                return $this->roles->first();
            })),
        ];
    }
}
