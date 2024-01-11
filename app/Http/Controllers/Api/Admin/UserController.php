<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Requests\Admin\UserStoreRequest;
use App\Http\Requests\Admin\UserUpdateRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index()
    {
        return UserResource::collection(
            User::with(['media', 'roles'])->latest()->paginate()
        );
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param \App\Http\Requests\Admin\UserStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        User::create($request->validated())
            ->assignRole($request->role);

        return ok();
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param \App\Http\Requests\Admin\UserUpdateRequest $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $user->update($request->validated());
        $user->syncRoles($request->role);

        return ok();
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param \App\Models\User
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', User::class);

        // ..
    }
}
