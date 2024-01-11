<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('notifications.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// Broadcast message to the partner
Broadcast::channel('chat.{id}', function ($user, $id) {
    return (int) $user->id == (int) $id;
});

// Broadcast mark conversation as seen
Broadcast::channel('chat-seen.{id}', function ($user, $id) {
    return (int) $user->id == (int) $id;
});

// Broadcast typing event
Broadcast::channel('xxx', function ($user) {
    \Log::info('typing channel' . $user->id/*  .' '. $id */);
    return Auth::check();
    // return true;
});
