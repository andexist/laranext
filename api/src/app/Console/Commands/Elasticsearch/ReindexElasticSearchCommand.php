<?php

namespace App\Console\Commands\Elasticsearch;

use App\Exceptions\Elasticsearch\ElasticsearchRepositoryNotFoundException;
use App\Models\Task;
use App\Services\Elasticsearch\Task\TaskElasticsearchService;
use Illuminate\Console\Command;

class ReindexElasticSearchCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'elasticsearch:reindex
                            {userId : The ID of the user}
                            {repository : The name of the repository}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reindexes Elasticsearch records for a specific user and repository. ' . 
                                'This command updates the Elasticsearch index by fetching the latest ' .
                                'data from the repository associated with the given user ID';

    public function __construct(private TaskElasticsearchService $taskElasticsearchService)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $userId = $this->argument('userId');
        $repository = $this->argument('repository');

        switch($repository) {
            case 'task':
                $this->reindexTasks($userId);
                break;
            default:
                throw new ElasticsearchRepositoryNotFoundException($repository);
        }
    }

    private function reindexTasks($userId)
    {
        // delete all existing records
        $this->taskElasticsearchService->deleteAllByIndex($userId);

       $tasks = Task::where('author_id', $userId)->get();

       if ($tasks->isEmpty()) {
            return $this->info("No tasks to reindex");
       }

        foreach($tasks as $task) {
            $this->taskElasticsearchService->createOrUpdate($userId, $task);
            $this->info(sprintf("Task with id of `%d` successfully reindexed", $task->id));
        }
    }
}
