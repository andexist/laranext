<?php

namespace App\Http\Controllers\API\V1\Task;

use App\Helpers\CollectionPaginator;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\PaginatorRequest;
use App\Http\Requests\API\V1\Task\StoreTaskRequest;
use App\Http\Requests\API\V1\Task\UpdateTaskRequest;
use App\Http\Resources\V1\TaskResource;
use App\Http\Resources\V1\TaskResourceCollection;
use App\Models\Task;
use App\Services\Task\TaskService;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    public function __construct(private TaskService $taskService)
    {}
    
    /**
     * Display a listing of the resource.
     */
    public function index(PaginatorRequest $request)
    {
        // uncomment this for testing api response
        //$user = User::where('email', 'john@test.com')->firstOrFail();
        $user = auth()->user();

        $tasks = CollectionPaginator::paginate($user->tasks, $request->pageSize());

        return new TaskResourceCollection($tasks);
    }

     /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return (new TaskResource($task))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $task = new Task();
        $task->id = null;
        $task->title = $request->title();
        $task->body = $request->body();
        $task->time_estimated = $request->timeEstimated();
        $task->time_spent = $request->timeSpent();
        $task->author_id = auth()->id() ?? $request->get('author_id');

        $this->taskService->createOrUpdate($task);

        return (new TaskResource($task))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->title = $request->title();
        $task->body = $request->body();
        $task->time_estimated = $request->timeEstimated();
        $task->time_spent = $request->timeSpent();
        $task->author_id = auth()->id() ?? $request->get('author_id');

        $this->taskService->createOrUpdate($task);

        return (new TaskResource($task))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $this->taskService->delete($task);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
