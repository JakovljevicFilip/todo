<?php

use App\Http\Controllers\Task\Change\ChangeTaskController;
use App\Http\Controllers\Task\Create\CreateTaskController;
use App\Http\Controllers\Task\Delete\DeleteTaskController;
use App\Http\Controllers\Task\List\ListTaskController;
use App\Http\Controllers\Task\View\ViewTaskController;
use Illuminate\Support\Facades\Route;

Route::post('/tasks', [CreateTaskController::class, 'create'])->name('tasks.create');
Route::post('/tasks/{task}', [ChangeTaskController::class, 'change'])->name('tasks.change');
Route::post('/tasks/{task}/delete', [DeleteTaskController::class, 'delete'])->name('tasks.delete');
Route::get('/tasks', [ListTaskController::class, 'list'])->name('tasks.list');
Route::get('/tasks/{task}', [ViewTaskController::class, 'view'])->name('tasks.view');
