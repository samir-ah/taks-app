<?php

namespace App\Actions;

use App\Models\AppJob;
use App\Http\Resources\AppJobResource;
use Lorisleiva\Actions\Concerns\AsAction;

class GetAppJobAction
{
    use AsAction;

    public function handle(AppJob $appJob): AppJobResource
    {
        return new AppJobResource($appJob);
    }

    public function asController(string $uuid): AppJobResource
    {
        $data = AppJob::where('uuid', $uuid)->firstOrFail();

        return $this->handle($data);
    }
}
