<?php

namespace App\Elasticsearch;

use Elastic\Elasticsearch\Client;

interface ElasticsearchClientInterface
{
    public function getClient(): Client;
}
