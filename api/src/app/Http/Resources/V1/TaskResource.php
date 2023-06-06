<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class TaskResource extends JsonResource
{

public static $wrap = 'tasks';

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'tasks',
            'id' => $this->id(),
            'attributes' => [
                'title' => $this->title(),
                'body' => $this->body(),
                'time_estimated' => $this->timeEstimated(),
                'time_spent' => $this->timeSpent(),
                'created_at' => Carbon::createFromFormat(
                    'Y-m-d H:i:s', 
                    $this->created_at
                )->toDateTimeString(),
                'updated_at' => Carbon::createFromFormat(
                    'Y-m-d H:i:s', 
                    $this->updated_at
                )->toDateTimeString(),
            ],
            'relationships' => [
                'author' => AuthorResource::make($this->author()),
            ],
            'links' => [
                'self' => route('tasks.show', $this->id()),
            ],
        ];
    }

    public function with(Request $request): array
    {
        return [
            'status' => 'success'
        ];
    }

    public function withResponse($request, $response)
    {
        $response->header('Accept', 'application/json');
    }
}
