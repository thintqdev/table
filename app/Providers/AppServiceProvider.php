<?php

namespace App\Providers;

use App\Services\S3Service;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;
use Illuminate\Validation\ValidationException;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('apiSuccess', function ($data, $message = [], $code = HttpFoundationResponse::HTTP_OK) {
            return response()->json([
                'status' => true,
                'data' => $data,
                'message' => $message
            ], $code);
        });

        Response::macro('apiError', function ($errors, $message = [], $code = HttpFoundationResponse::HTTP_BAD_REQUEST) {
            return response()->json([
                'status' => false,
                'errors' => $errors,
                'message' => $message
            ], $code);
        });
    }
}
