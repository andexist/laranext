<?php

namespace App\Exceptions\Elasticsearch;

use App\Exceptions\InvalidArgumentException;

class ElasticsearchRepositoryNotFoundException extends InvalidArgumentException
{
    public function __construct(string $repositoryName)
    {
        parent::__construct(
            'ElasticsearchRepositoryNotFoundException',
            sprintf('Repository "%s" not found.', $repositoryName)
        );
    }
}