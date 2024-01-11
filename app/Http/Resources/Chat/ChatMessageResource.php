<?php

namespace App\Http\Resources\Chat;

use App\Enums\MessageType;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatMessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' =>  $this->id,
            'from_id' =>  $this->from_id,
            'to_id' =>  $this->to_id,
            'type' => MessageType::from($this->type),
            'body' => $this->body,
            'is_seen' => $this->is_seen,
            'created_at' => $this->created_at->format('h:i:A'),
            'source' => $this->when(
                $this->type === MessageType::VOICE->value, fn () => $this->getFirstMediaUrl('voice')
            ),
            'user' => $this->whenLoaded('user', fn () => [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'avatar' => $this->user->getFirstMediaUrl('avatar', 'thumb'),
            ]),
        ];
    }
}
