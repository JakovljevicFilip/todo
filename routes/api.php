<?php

use App\Http\Controllers\Task\Change\ChangeTaskController;
use App\Http\Controllers\Task\Create\CreateTaskController;
use App\Http\Controllers\Task\Complete\CompleteTaskController;
use App\Http\Controllers\Task\Delete\DeleteTaskController;
use App\Http\Controllers\Task\List\ListTaskController;
use App\Http\Controllers\Task\ListCompleted\ListCompletedTaskController;
use App\Http\Controllers\Task\View\ViewTaskController;
use Illuminate\Support\Facades\Route;

Route::prefix('/tasks')->name('tasks.')->group(function () {
    Route::post('/', [CreateTaskController::class, 'create'])->name('create');
    Route::post('/{task}', [ChangeTaskController::class, 'change'])->name('change');
    Route::post('/{task}/delete', [DeleteTaskController::class, 'delete'])->name('delete');
    Route::post('/{task}/complete', [CompleteTaskController::class, 'complete'])->name('complete');

    Route::get('/', [ListTaskController::class, 'list'])->name('list');
    Route::get('/completed', [ListCompletedTaskController::class, 'list_completed'])->name('list_completed');
    Route::get('/{task}', [ViewTaskController::class, 'view'])->name('view');
});
