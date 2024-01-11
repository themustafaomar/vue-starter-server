<?php

use App\Models\User;
use App\Events\RandomUserFetched;
use Illuminate\Support\Facades\Route;
use App\Notifications\WelcomeNotification;
use App\Notifications\FriendRequestNotification;

// Test endpoint
Route::post('/notifications/broadcast', function () {
    $user = User::whereEmail('themustafaomar@gmail.com')->first();

    $user->notify(new WelcomeNotification($user));
    $user->notify(new FriendRequestNotification($user));

    return ok();
});

Route::get('/broadcasting/random/user', function () {
    $user = User::inRandomOrder()->first();

    broadcast(new RandomUserFetched($user));

    return ok();
});
