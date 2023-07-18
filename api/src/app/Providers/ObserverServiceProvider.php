<?php

namespace App\Providers;

use App\Observers\TaskObserver;
use Illuminate\Support\ServiceProvider;
use App\Models\Task;

class ObserverServiceProvider extends ServiceProvider
{
    private $observers = [
        Task::class => TaskObserver::class,
    ];

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
        foreach($this->observers as $model => $observer) {
            $model::observe($observer);
        }
    }
}
