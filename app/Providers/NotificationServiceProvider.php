<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Library\Services\NotificationsService;

class NotificationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind('App\Library\Services\NotificationsService', function ($app) {
          return new NotificationsService();
        });
    }
}
