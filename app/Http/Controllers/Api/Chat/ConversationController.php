<?php

namespace App\Http\Controllers\Api\Chat;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Events\Chat\ConversationSeen;
use App\Http\Resources\Chat\ChatConversationResource;

class ConversationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $id = Auth::id();
        $latest_message = DB::table('messages')
            ->selectRaw(
                'IF(messages.from_id = ?, messages.to_id, messages.from_id) AS contact_id,'.
                'MAX(messages.id) AS latest_message_id,'.
                'MAX(messages.created_at) AS created_at'
            )
            ->where('messages.from_id', $id)
            ->orWhere('messages.to_id', $id)
            ->groupBy('contact_id');

    $contacts = User::query()
        ->select([
            'users.id',
            'users.name',
            'latest_message.created_at AS last_message_created',
        ])
        ->selectSub(function ($builder) {
            $builder->select('body')->from('messages')->whereColumn('messages.id', 'latest_message_id');
        }, 'body')
        ->selectSub(function ($builder) {
            $builder->select('is_seen')->from('messages')->whereColumn('messages.id', 'latest_message_id');
        }, 'is_seen')
        ->selectSub(function ($builder) {
            $builder->select('type')->from('messages')->whereColumn('messages.id', 'latest_message_id');
        }, 'type')
        ->selectSub(function ($builder) {
            $builder->select('from_id')->from('messages')->whereColumn('messages.id', 'latest_message_id');
        }, 'from_id')
        ->joinSub($latest_message, 'latest_message', function ($join) use ($id) {
            $join->on('users.id', 'latest_message.contact_id')->addBinding($id, 'select');
        })
        ->where('users.id', '!=', $id)
        ->orderBy('last_message_created', 'desc')
        ->get();

        return ChatConversationResource::collection($contacts);
    }

    /**
     * Start a new conversation by getting the user info
     * 
     * @param \App\Models\User $user
     * @return \App\Http\Resources\Chat\ChatConversationResource
     */
    public function newConversation(User $user)
    {
        $user->load('media');

        return new ChatConversationResource($user);
    }

    /**
     * Mark conversation as seen
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function markAsSeen(Request $request, $id)
    {
        Message::where('from_id', $request->user()->id)
            ->where('to_id', $id)
            ->orWhere('from_id', $id)
            ->where('to_id', $request->user()->id)
            ->where('is_seen', false)
            ->get()
            ->each
            ->markAsSeen();

        broadcast(new ConversationSeen($id));

        return ok();
    }
}
