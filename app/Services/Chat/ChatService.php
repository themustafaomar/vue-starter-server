<?php

namespace App\Services\Chat;

use App\Models\Message;
use Illuminate\Http\Request;

class ChatService
{
    /**
     * Create a chat message
     * 
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function make(Request $request)
    {
        $data = [
            'from_id' => $request->user()->id,
            'to_id' => $request->id,
            'type' => $request->type,
            'body' => $request->type === 'text' ? $request->body : null,
        ];

        $message = Message::create($data);

        if ($request->type === 'record') {
            $message->addMediaFromRequest('record')
                ->toMediaCollection('record', 'public')
                ->getFullUrl();
        }

        return $message;
    }
}
