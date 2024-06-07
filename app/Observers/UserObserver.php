<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "saving" event.
     */
    public function saving(User $user): void
    {
        if (is_null(request('avatar'))) {
            return;
        }

        $user->addMediaFromRequest('avatar')
            ->toMediaCollection('avatar');
    }
}
