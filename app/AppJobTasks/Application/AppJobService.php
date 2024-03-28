<?php

namespace App\AppJobTasks\Application;

use App\AppJobTasks\Models\AppJob;
use App\AppJobTasks\Actions\ProcessTaskJobAction;
use App\AppJobTasks\Infrastructure\AppJobRepository;

class AppJobService
{
    public function __construct(private AppJobRepository $appJobRepository)
    {
    }

    public function createAppJob(string $title): AppJob
    {

        return $this->appJobRepository->create($title);
    }

    public function getAppJobByUuid(string $uuid): AppJob
    {
        return $this->appJobRepository->findByUuid($uuid);
    }

    public function processTasks(array $tasks, AppJob $job)
    {
        foreach ($tasks as $task) {
            // Enqueue each task for processing.
            ProcessTaskJobAction::dispatch($task, $job->uuid);
        }
    }
}
