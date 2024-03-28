<?php

namespace App\AppJobTasks\Infrastructure;

use App\AppJobTasks\Models\AppJob;

class AppJobRepository
{
    public function create(string $title): AppJob
    {
        return AppJob::create([
            'uuid' => (string) \Illuminate\Support\Str::uuid(),
            'title' => $title,
        ]);
    }

    public function findByUuid(string $uuid): AppJob
    {
        return AppJob::where('uuid', $uuid)->firstOrFail();
    }
}
