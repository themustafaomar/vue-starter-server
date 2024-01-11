<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\LoginResource;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): LoginResource
    {
        $request->authenticate();

        $request->session()->regenerate();

        $request->user()->loadMedia('avatar');

        return new LoginResource($request->user());
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)/* : Response */
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return ok();
    }
}
