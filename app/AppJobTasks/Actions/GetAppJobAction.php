<?php

namespace App\AppJobTasks\Actions;

use App\AppJobTasks\Models\AppJob;
use Lorisleiva\Actions\Concerns\AsAction;
use App\AppJobTasks\Application\AppJobService;
use App\AppJobTasks\Http\Resources\AppJobResource;

class GetAppJobAction
{
    use AsAction;

    public function __construct(private AppJobService $appJobService)
    {
    }

    public function handle(AppJob $appJob): AppJobResource
    {
        return new AppJobResource($appJob);
    }

    public function asController(string $uuid): AppJobResource
    {
        $data = $this->appJobService->getAppJobByUuid($uuid);

        return $this->handle($data);
    }
}
