<?php

namespace App\Actions;

use App\TaskEnum;
use Illuminate\Validation\Rule;
use App\Actions\ProcessTaskJobAction;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateAppJobAction
{
    use AsAction;

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
        $job = \App\Models\AppJob::create([
            'uuid' => (string) \Illuminate\Support\Str::uuid(),
            'title' => $data['text'],
        ]);

        foreach ($data['tasks'] as $task) {
            // Enqueue each task for processing.
            ProcessTaskJobAction::dispatch($task, $job->uuid);
        }

        return ['jobId' => $job->uuid];
    }
   
    public function asController(ActionRequest $request): array
    {
        $data = $request->only('text', 'tasks');

        return $this->handle($data);
    }
}
