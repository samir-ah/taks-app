<?php

use App\AppJobTasks\Actions\ProcessTaskJobAction;
use function Pest\Stressless\stress;

describe('AppJobActionsTest', function () {

    it('Check AppJob is successfuly created and check it exists', function () {

        $response = $this->postJson('/api/jobs', [
            'title' => 'Task random',
            'tasks' => ['call_reason', 'call_segments']
        ]);
        $response->assertStatus(201);
        expect($response['jobId'])->toBeString();

        $response2 = $this->getJson('/api/jobs/' . $response['jobId']);
        $response2->assertStatus(200);
        $response2->assertJson([
            'data' => [
                'id' => $response['jobId'],
                'title' => 'Task random'
            ]
        ]);
    });

    it('Check creation fails with validation tasks errors', function () {

        $response = $this->postJson('/api/jobs', [
            'title' => 'Task random',
            'tasks' => []
        ]);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('tasks');

        $response2 = $this->postJson('/api/jobs', [
            'title' => 'Task random',
            'tasks' => ['call_reason', 'call_segments', 'invalid_task']
        ]);
        $response2->assertStatus(422);
        $response2->assertJsonValidationErrors('tasks.2');
    });

    it('Check creation fails with validation title errors', function () {

        $response = $this->postJson('/api/jobs', [
            'title' => '',
            'tasks' => ['call_reason', 'call_segments']
        ]);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('title');

        $response2 = $this->postJson('/api/jobs', [
            'tasks' => ['call_reason', 'call_segments']
        ]);
        $response2->assertStatus(422);
        $response2->assertJsonValidationErrors('title');
    });

    it('Check get job fails with not found', function () {

        $response = $this->getJson('/api/jobs/invalid_uuid');
        $response->assertStatus(404);
    });

    it('Check async job is pushed in queue when create AppJob', function () {

        Queue::fake();

        $this->postJson('/api/jobs', [
            'title' => 'Task random',
            'tasks' => ['call_reason', 'call_segments']
        ]);

        ProcessTaskJobAction::assertPushed();
    });

    it('Check async job is not pushed in queue when create AppJob fails', function () {

        Queue::fake();

        $this->postJson('/api/jobs', [
            'title' => 'Task random',
            'tasks' => ['call_reason', 'invalid']
        ]);

        ProcessTaskJobAction::assertNotPushed();
    });

    it('has a fast response time', function () {
        $result = stress('/api/jobs')->post([
            'title' => 'Task random',
            'tasks' => ['call_reason', 'call_segments']
        ])->for(5)->seconds();
     
        expect($result->requests()->duration()->med())->toBeLessThan(100); // < 100.00ms
    });
});
