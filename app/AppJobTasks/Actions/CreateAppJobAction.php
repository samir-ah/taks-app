<?php

namespace App\AppJobTasks\Actions;

use App\AppJobTasks\TaskEnum;
use Illuminate\Validation\Rule;
use App\AppJobTasks\Application\AppJobService;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateAppJobAction
{
    use AsAction;

    public function __construct(private AppJobService $appJobService)
    {
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'tasks' => 'required|array|min:1',
            'tasks.*' => ['required', Rule::in(TaskEnum::values())],
        ];
    }

    public function handle(array $data)
    {
        $job = $this->appJobService->createAppJob($data['title']);
        $this->appJobService->processTasks($data['tasks'], $job);

        return response(['jobId' => $job->uuid], 201);
    }
   
    public function asController(ActionRequest $request)
    {
        $data = $request->only('title', 'tasks');

        return $this->handle($data);
    }
}
