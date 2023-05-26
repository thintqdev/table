<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class AuthorizationController extends Controller
{
    public function updateRole(Role $role, Request $request)
    {
        $role->update($request->all());

        return response()->apiSuccess(true);
    }
}
