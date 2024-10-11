<?php

use App\Http\Controllers\Task\Create\CreateTaskController;
use Illuminate\Support\Facades\Route;

Route::post('/tasks', [CreateTaskController::class, 'create'])->name('tasks.create');
