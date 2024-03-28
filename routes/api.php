<?php


use App\AppJobTasks\Actions\CreateAppJobAction;
use App\AppJobTasks\Actions\GetAppJobAction;
use Illuminate\Support\Facades\Route;

Route::post('/jobs', CreateAppJobAction::class);

Route::get('/jobs/{uuid}', GetAppJobAction::class);

