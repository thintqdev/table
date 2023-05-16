<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ChangePasswordRequest;
use Auth;
use Hash;

class ProfileController extends Controller
{
    public function changePassword(ChangePasswordRequest $request)
    {
        $user = Auth::user();

        if (!Hash::check($request->password, $user->password)) {
            return response()->apiError([], __('auth.password'));
        }

        $user->password = bcrypt($request->new_password);
        $user->save();

        return response()->apiSuccess(true, __('message.admin.success_change_password'));
    }
}
