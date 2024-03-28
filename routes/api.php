<?php


use App\Actions\CreateAppJobAction;
use App\Actions\GetAppJobAction;
use Illuminate\Support\Facades\Route;

Route::post('/jobs', CreateAppJobAction::class);

Route::get('/jobs/{uuid}', GetAppJobAction::class);

