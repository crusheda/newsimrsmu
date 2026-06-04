<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Services\HeaderService;
use App\Services\NotificationService;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {

            if (!auth()->check()) {
                return;
            }

            $view->with(
                'headerUser',
                app(HeaderService::class)->get()
            );

            $view->with(
                'notifications',
                app(NotificationService::class)->get()
            );
        });
    }
}
