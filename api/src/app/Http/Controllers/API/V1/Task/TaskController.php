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
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
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
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $task = Task::create([
            'title' => $request->title(),
            'body' => $request->body(),
            'time_estimated' => $request->timeEstimated(),
            'time_spent' => $request->timeSpent(),
            'author_id' => auth()->id() ?? $request->get('author_id'),
        ]);

        return (new TaskResource($task))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
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
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->update([
            'title' => $request->title(),
            'body' => $request->body(),
            'time_estimated' => $request->timeEstimated(),
            'time_spent' => $request->timeSpent(),
            'author_id' => auth()->id() ?? 1,
        ]);

        return (new TaskResource($task))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
