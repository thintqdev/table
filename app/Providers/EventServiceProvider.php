<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\QRStamp;
use App\Models\Shop;
use App\Observers\ProductObserver;
use App\Observers\QRStampObserver;
use App\Observers\ShopObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * The model observers for your application.
     *
     * @var array
     */
    protected $observers = [
        Shop::class => [ShopObserver::class],
        Product::class => [ProductObserver::class],
        QRStamp::class => [QRStampObserver::class],
    ];
}
