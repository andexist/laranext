<?php

namespace App\Http\Controllers;

use App\DTO\Cache\Task\TaskCacheDTO;
use App\Models\Task;
use App\Redis\RedisClientInterface;
use App\Services\Redis\Task\TaskCacheService;
use Illuminate\Http\Request;

class TestRedisController extends Controller
{
    public function __construct(private TaskCacheService $taskCacheService)
    {}

    public function __invoke()
    {
        //$this->redis->getClient()->set('name', "John Doe");

        // $task = Task::find(2);
        // $this->taskCacheService->set($task->id, new TaskCacheDTO(
        //     $task->id,
        //     $task->title,
        //     $task->body,
        //     $task->time_estimated,
        //     $task->time_spent,
        //     $task->author_id,
        //     $task->created_at,
        //     $task->updated_at
        // ));

        $task = $this->taskCacheService->get(2);

        dd($task);
    }
}
