<?php

namespace App\Elasticsearch;

use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;

class ElasticsearchClient implements ElasticsearchClientInterface
{
    private Client $client;

    public function __construct(string $host)
    {
        $this->client = ClientBuilder::create()->setHosts([$host])->build();
    }

    public function getClient(): Client
    {
        return $this->client;
    }
}
