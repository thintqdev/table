<?php

namespace App\Observers;

use App\Jobs\InviteShopMailJob;
use App\Models\Shop;
use App\Models\User;
use Str;

class ShopObserver
{
    /**
     * Handle the Shop "created" event.
     *
     * @param  \App\Models\Shop  $shop
     * @return void
     */
    public function created(Shop $shop)
    {
        $password = Str::random();
        $user = User::create([
            'name' => $shop->representative_name,
            'email' => $shop->email,
            'password' => bcrypt($password),
            'shop_id' => $shop->id,
        ]);
        $data = $shop->toArray();
        $data['password'] = $password;

        dispatch(new InviteShopMailJob($data));
    }

    /**
     * Handle the Shop "updated" event.
     *
     * @param  \App\Models\Shop  $shop
     * @return void
     */
    public function updated(Shop $shop)
    {
        //
    }

    /**
     * Handle the Shop "deleted" event.
     *
     * @param  \App\Models\Shop  $shop
     * @return void
     */
    public function deleted(Shop $shop)
    {
        //
    }

    /**
     * Handle the Shop "restored" event.
     *
     * @param  \App\Models\Shop  $shop
     * @return void
     */
    public function restored(Shop $shop)
    {
        //
    }

    /**
     * Handle the Shop "force deleted" event.
     *
     * @param  \App\Models\Shop  $shop
     * @return void
     */
    public function forceDeleted(Shop $shop)
    {
        //
    }
}
