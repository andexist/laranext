<?php

namespace App\Http\Resources\V1\Elasticsearch\Task;

use App\Entities\Task\TaskEntity;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskElasticsearchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $results = $this->resource;

        return array_map(function (TaskEntity $entity) {
            return [
                'uniqid' => $entity->getUniqid(),
                'title' => $entity->getTitle(),
                'body' => $entity->getBody(),
                'time_estimated' => $entity->getTimeEstimated(),
                'time_spent' => $entity->getTimeSpent(),
                'created_at' => $entity->getCreatedAt(),
            ];
        }, $results);
    }
}
