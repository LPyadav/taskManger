<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\TaskAssignObserver;
use App\Models\TaskAssign;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //TaskAssign::observe(TaskAssignObserver::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        TaskAssign::observe(TaskAssignObserver::class);

    }
}
