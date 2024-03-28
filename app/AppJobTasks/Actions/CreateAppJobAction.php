<?php

namespace App\AppJobTasks\Actions;

use App\AppJobTasks\TaskEnum;
use Illuminate\Validation\Rule;
use App\AppJobTasks\Actions\ProcessTaskJobAction;
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
            'text' => 'required|string|max:255',
            'tasks' => 'required|array|min:1',
            'tasks.*' => ['required', Rule::in(TaskEnum::values())],
        ];
    }

    public function handle(array $data): array
    {
        $job = $this->appJobService->createAppJob($data['text']);
        $this->appJobService->processTasks($data['tasks'], $job);

        return ['jobId' => $job->uuid];
    }
   
    public function asController(ActionRequest $request): array
    {
        $data = $request->only('text', 'tasks');

        return $this->handle($data);
    }
}
