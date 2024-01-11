<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Auth::login(User::first());

// Attention, this is only for development and will
// be removed in producton environment, this is because
// laravel-cors fails sometimes when dd something for debugging.
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Headers: x-xsrf-token, x-requested-with, content-type');

// ---------------------------------------------------
// Admin routes
// ---------------------------------------------------
Route::namespace('Admin')
    ->middleware(['auth:sanctum', /* 'role:super-admin' */])
    ->group(function () {
        Route::apiResource('/users', UserController::class)->except('show');
        Route::apiResource('/roles', RoleController::class);
        Route::get('/permissions', PermissionController::class);
    });

// ---------------------------------------------------
// Common routes
// ---------------------------------------------------
Route::middleware('auth:sanctum')->group(function () {
    // Profile
    Route::post('/profile', ProfileController::class);
    Route::post('/profile/avatar', ProfileController::class.'@changeAvatar');
    Route::post('/profile/update-password', ProfileController::class.'@updatePassword');

    // Notifications
    Route::apiResource('/notifications', NotificationController::class)->only('index', 'destroy');
    Route::post('/notifications/{notification}/markas-read', NotificationController::class.'@markAsRead');

    // Chat
    Route::get('/chat/conversations', Chat\ConversationController::class);
    Route::get('/chat/conversations/new/{user}', Chat\ConversationController::class.'@newConversation');
    Route::post('/chat/conversations/{user}/seen', Chat\ConversationController::class.'@markAsSeen');
    Route::get('/chat/{user}', Chat\ChatController::class.'@index');
    Route::post('/chat', Chat\ChatController::class.'@store');
});

// ---------------------------------------------------
// Development testing routes
// ---------------------------------------------------
require_once __DIR__.'/testing.php';
