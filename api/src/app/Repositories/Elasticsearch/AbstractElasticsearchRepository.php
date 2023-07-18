<?php

namespace App\Repositories\Elasticsearch;

use App\Elasticsearch\ElasticsearchClientInterface;
use Laminas\Hydrator\ReflectionHydrator;
use App\Repositories\Elasticsearch\Interfaces\AbstractElasticsearchRepositoryInterface;

abstract class AbstractElasticsearchRepository implements AbstractElasticsearchRepositoryInterface
{
    public function __construct(
        private ElasticsearchClientInterface $elasticserach,
        private string $entityClass
    ) 
    {}

    abstract protected function buildSearchParams(int $userId, string $query): array;
    
    abstract protected function buildUpsertParams(int $userId, object $data): array;

    abstract protected function index(int $userId): string;

    abstract protected function uniqid(object $data): string;

    public function search(int $userId, string $query): array
    {
        $records = $this->elasticserach->getClient()->search(
            $this->buildSearchParams($userId, $query)
        )['hits']['hits'];

        $results = [];
        $hydrator = new ReflectionHydrator();
        
        if (!empty($records)) {
            foreach ($records as $record) {
                $source = $record['_source'];
                $results[] = $hydrator->hydrate($source, new $this->entityClass());
            }
        }

        return $results;
    }

    public function createOrUpdate(int $userId, object $data): void
    {
        $this->elasticserach->getClient()->update(
            $this->buildUpsertParams($userId, $data)
        );
    }

    public function delete(int $userId, object $data): void
    {
        $this->elasticserach->getClient()->delete([
            'index' => $this->index($userId),
            'id' => $this->uniqId($data),
        ]);
                  
    }

    public function deleteAllByIndex(int $userId): void
    {
        $records = $this->findAllByIndex($userId);

        if (!empty($records)) {
            foreach($records as $record) {
                $this->elasticserach->getClient()->delete([
                    'index' => $record['_index'],
                    'id' => $record['_id'],
                ]);
            }
        }
    }

    public function findAllByIndex(int $userId): array
    {
        return $this->elasticserach->getClient()->search(
            [
                'index' => $this->index($userId)
            ]
        )['hits']['hits'];
    }
}
