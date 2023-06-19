<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all(['id', 'name'])->sortByDesc(function ($q) {
            $q->orderBy('name');
        });

        return response()->apiSuccess($permissions);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['guard_name'] = 'sanctum';

        $permission = Permission::create($request->all());

        return response()->apiSuccess($permission);
    }

    public function update(Permission $permission, Request $request)
    {
        $permission->update($request->all());

        return response()->apiSuccess(true);
    }

    public function delete(Permission $permission)
    {
        $permission->delete();

        return response()->apiSuccess(true);
    }

    public function assignPermissionToRole(Request $request)
    {
        $role = Role::findById($request->role_id);

        $role->permissions()->sync($request->permission_ids);

        return response()->apiSuccess(true);
    }
}
