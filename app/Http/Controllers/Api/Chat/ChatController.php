<?php

namespace App\Http\Controllers\Api\Chat;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Services\Chat\ChatService;
use Illuminate\Support\Facades\DB;
use App\Events\Chat\MessageReceived;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Chat\MessageStoreRequest;
use App\Http\Resources\Chat\ChatMessageResource;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @param int $id
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index($id)
    {
        $messages = Message::query()
            ->where('from_id', Auth::id())
            ->where('to_id', $id)
            ->orWhere('from_id', $id)
            ->where('to_id', Auth::id())
            ->with([
                'media',
                'user:id,name',
                'user.media',
            ])
            ->latest('id')
            ->paginate();

        $items = request('page')
            ? $messages->getCollection()
            : $messages->getCollection()->reverse();

        return ChatMessageResource::collection($items)
            ->additional([
                'meta' => [
                    'current_page' => $messages->currentPage(),
                    'last_page' => $messages->lastPage(),
                ]
            ]);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param \App\Http\Requests\Chat\MessageStoreRequest $request
     * @param \App\Services\Chat\ChatService $service
     * @return \Illuminate\Http\Response
     */
    public function store(MessageStoreRequest $request, ChatService $service)
    {
        $message = $service->make($request);

        broadcast(new MessageReceived($message));

        return ok();
    }
}
