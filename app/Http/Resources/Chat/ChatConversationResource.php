<?php

namespace App\Http\Resources\Chat;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatConversationResource extends JsonResource
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
            'from_id' => $this->from_id,
            'name' => $this->name,
            'avatar' => $this->getFirstMediaUrl('avatar', 'thumb'),
            'type' => $this->type,
            'body' => $this->body,
            'last_message_created' => $this->last_message_created,
            'unread_count' => $this->unread_count,
        ];
    }
}
