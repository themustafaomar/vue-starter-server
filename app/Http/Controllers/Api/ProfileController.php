<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\ProfileUpdatePasswordRequest;

class ProfileController extends Controller
{
    /**
     * Handle the incoming request.
     * 
     * @param \App\Http\Requests\ProfileUpdateRequest
     * @return \Illuminate\Http\Response
     */
    public function __invoke(ProfileUpdateRequest $request)
    {
        $request->user()->update($request->validated());

        return ok();
    }

    /**
     * Update the user's profile picture
     * 
     * @param \App\Http\Requests\ProfileUpdatePasswordRequest
     * @return \Illuminate\Http\Response
     */
    public function changeAvatar(Request $request)
    {
        $this->validate($request, [
            'avatar' => ['required', 'image'],
            'coords' => ['required'],
        ]);

        $url = $request->user()->addMediaFromRequest('avatar')
            ->withCustomProperties([
                'coords' => explode(',', $request->coords)
            ])
            ->toMediaCollection('avatar', 'public')
            ->getFullUrl('thumb');

        return ok(['avatar' => $url]);
    }

    /**
     * Update user password
     * 
     * @param \App\Http\Requests\ProfileUpdatePasswordRequest
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(ProfileUpdatePasswordRequest $request)
    {
        $user = $request->user();

        if (! Hash::check($request->old_password, $user->password)) {
            throw ValidationException::withMessages([
                'old_password' => 'The old password is wrong',
            ]);
        }

        $user->update([
            'password' => bcrypt($request->password),
        ]);

        return ok();
    }
}
