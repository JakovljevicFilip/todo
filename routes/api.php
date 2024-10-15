<?php

use App\Http\Controllers\Task\Create\CreateTaskController;
use App\Http\Controllers\Task\List\ListTaskController;
use Illuminate\Support\Facades\Route;

Route::post('/tasks', [CreateTaskController::class, 'create'])->name('tasks.create');
Route::get('/tasks', [ListTaskController::class, 'list'])->name('tasks.list');
