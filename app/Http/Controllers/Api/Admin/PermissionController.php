<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PermissionResource;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function __invoke(Request $request)
    {
        $relations = $request->boolean('roles') ? 'roles' : [];

        return PermissionResource::collection(
            Permission::latest()->with($relations)->get()
        );
    }
}
