<?php

declare(strict_types=1);

namespace App\Http\Controllers\Task\ListCompleted;

use App\Http\Controllers\Controller;
use App\Models\Task\Status;
use App\Models\Task\Task;
use Illuminate\Http\JsonResponse;

class ListCompletedTaskController extends Controller
{
    public function list_completed(): JsonResponse
    {
        $tasks = Task::where('status', Status::COMPLETED)
            ->orderBy('updated_at', 'desc')
            ->get();

        return response()->json($tasks);
    }
}
