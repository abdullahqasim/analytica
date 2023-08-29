<?php

namespace App\Console\Commands;

use App\Models\Task;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class SyncTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:tasks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch tasks from API and sync with local database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $apiData = Http::get('https://jsonplaceholder.typicode.com/todos')->json();

        foreach ($apiData as $taskData) {
            Task::updateOrCreate(
                ['api_id' => $taskData['id']],
                [
                    'title' => $taskData['title'],
                    'completed' => $taskData['completed']
                ]
            );
        }

        $this->info('Tasks synchronized successfully.');
    }
}
