<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\HttpRequestController;


Route::get('/', function () {
    return redirect()->route('tasks.index');
});

Route::resource('tasks', TaskController::class)->except(['edit', 'update']);

Route::get('/fetch-data', [HttpRequestController::class, 'fetchData']);
