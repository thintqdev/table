<?php

namespace App\Services\Admin;

use App\Jobs\InviteOwnerMailJob;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;

class OwnerService
{
    public function inviteOwner($data)
    {
        $data['password'] = Str::random();
        $owner = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        $owner->assignRole(Role::OWNER);
        dispatch(new InviteOwnerMailJob($data));

        return $owner;
    }
}
