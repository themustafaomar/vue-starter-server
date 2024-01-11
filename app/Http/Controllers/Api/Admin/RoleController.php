<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use App\Http\Requests\Admin\RoleStoreRequest;
use App\Http\Requests\Admin\RoleUpdateRequest;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Role::class);

        return RoleResource::collection(
            Role::latest()->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param \App\Http\Requests\Admin\RoleStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleStoreRequest $request)
    {
        $role = Role::create($request->validated());

        if ($request->filled('permissions')) {
            $role->permissions()->attach($request->permissions);
        }

        return ok();
    }

    /**
     * Display the specified resource.
     * 
     * @param \App\Models\Role $role
     * @return \App\Http\Resources\RoleResource
     */
    public function show(Role $role)
    {
        return new RoleResource($role->load('permissions'));
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param \App\Http\Requests\Admin\RoleUpdateRequest $request
     * @param \App\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleUpdateRequest $request, Role $role)
    {
        $role->update($request->validated());

        if ($request->filled('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        return ok();
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param \App\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $this->authorize('delete', Role::class);

        $role->delete();

        return ok();
    }
}
