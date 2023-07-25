<?php

namespace App\Providers;

use App\Elasticsearch\ElasticsearchClient;
use App\Elasticsearch\ElasticsearchClientInterface;
use App\Redis\RedisClient;
use App\Redis\RedisClientInterface;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Str::macro('snakeToTitle', function($value) {
            return ucfirst(str_replace('_', ' ', $value));
        });

        $this->app->singleton(
            ElasticsearchClientInterface::class,
            static function ($app) {
                return new ElasticsearchClient(
                    config('services.elasticsearch.host')
                );
            }
        );

        $this->app->singleton(
            RedisClientInterface::class,
            static function ($app) {
                return new RedisClient(
                    config('services.redis.host'),
                    config('services.redis.port'),
                );
            }
        );
    }
}
