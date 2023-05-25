<?php

namespace App\Services\Admin;

use Auth;

class AbstractService
{
    public function user()
    {
        return Auth::user();
    }

    public function userShop()
    {
        return $this->user()->shop_id;
    }
}