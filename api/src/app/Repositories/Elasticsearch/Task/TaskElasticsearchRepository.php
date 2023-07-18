<?php

namespace App\Repositories\Elasticsearch\Task;

use App\Entities\Task\TaskEntity;
use App\Exceptions\InvalidArgumentException;
use App\Models\Task;
use App\Elasticsearch\ElasticsearchClientInterface;
use Carbon\Carbon;
use App\Repositories\Elasticsearch\AbstractElasticsearchRepository;

class TaskElasticsearchRepository extends AbstractElasticsearchRepository
{
    public function __construct(ElasticsearchClientInterface $elasticsearch)
    {
        parent::__construct($elasticsearch, TaskEntity::class);
    }

    protected function buildSearchParams(int $userId, string $query): array
    {
        return [
            'index' => $this->index($userId),
            'body' => [
                'query' => [
                    'bool' => [
                        'should' => [
                            [
                                'multi_match' => [
                                    'query' => $query,
                                    'fields' => ['title', 'body'],
                                    'type' => 'cross_fields',
                                    'operator' => 'and',
                                    'lenient' => true,
                                ]
                            ],
                            [
                                'prefix' => [
                                    'title' => $query,
                                ],
                            ],
                        ],
                    ],
                ],
                'size' => 5,
            ], 
        ];
    }

    protected function buildUpsertParams(int $userId, object $data): array
    {
        return [
            'index' => $this->index($userId),
            'id' => $this->uniqId($data),
            'body' => [
                'doc' => [
                    'uniqid' => $this->uniqId($data),
                    'title' => $data->title(),
                    'body' => $data->body(),
                    'time_estimated' => $data->timeEstimated(),
                    'time_spent' => $data->timeSpent(),
                    'created_at' => Carbon::parse($data->createdAt())->toIso8601String(),
                ],
                'doc_as_upsert' => true,
            ]
        ];
    }

    protected function index(int $userId): string
    {
        return 'task-' . $userId;
    }

    protected function uniqId(object $data): string
    {
        if (!$data instanceof Task) {
            throw new InvalidArgumentException(
                sprintf('Invalid data object. Expected instance of %s', Task::class)
            );
        }

        return (string)$data->id;
    }
}
