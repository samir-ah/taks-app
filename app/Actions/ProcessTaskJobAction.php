<?php

namespace App\Actions;

use Log;
use Lorisleiva\Actions\Concerns\AsAction;

class ProcessTaskJobAction
{
    use AsAction;

    public function handle(string $task, string $jobId): void
    {
        // Mock processing of the task.
        Log::info("Processing task [{$task}] for job [{$jobId}]...");   
    }

    public function asJob(string $task, string $jobId): void
    {
        $this->handle($task, $jobId);
    }
}
