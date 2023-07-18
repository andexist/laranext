<?php

namespace App\Providers\Task;

use App\Repositories\Task\TaskRepository;
use App\Repositories\Task\Interfaces\TaskRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class TaskServiceProvider extends ServiceProvider
{
    private static $objects = [
        TaskRepository::class => TaskRepositoryInterface::class,
    ];

    public function register()
    {
        foreach(self::$objects as $object => $interface) {
            $this->app->bind($interface, $object);
        }
    }
}
