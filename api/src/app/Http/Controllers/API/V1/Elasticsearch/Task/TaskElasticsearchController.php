<?php

namespace App\Http\Controllers\API\V1\Elasticsearch\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\Elasticsearch\Task\TaskElasticsearchRequest;
use App\Http\Resources\V1\Elasticsearch\Task\TaskElasticsearchResource;
use App\Models\User;
use App\Services\Elasticsearch\Task\TaskElasticsearchService;

class TaskElasticsearchController extends Controller
{
    public function __construct(private TaskElasticsearchService $taskElasticsearchService)
    {}

    public function __invoke(TaskElasticsearchRequest $request)
    {
        // use this for testing purpose
        $user = User::where('email', 'john@test.com')->first();
        //$user = auth()->user();

        return response()->json(new TaskElasticsearchResource(
            $this->taskElasticsearchService->search($user->id, $request->getQuery())
        ));
    }
}
