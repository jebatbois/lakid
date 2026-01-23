<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use illuminate\support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
   public function boot(): void
{
    // Tambahkan ini agar CSS/Gambar aman saat di-deploy/ngrok
    if($this->app->environment('production') || !empty($_SERVER['HTTP_X_FORWARDED_PROTO'])){
        \Illuminate\Support\Facades\URL::forceScheme('https');
    }
}

protected $listen = [
    Registered::class => [
        SendEmailVerificationNotification::class,
    ],
];

}
