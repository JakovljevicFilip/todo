<?php

declare(strict_types=1);

namespace App\Http\Controllers\Task\View;

use App\Http\Controllers\Controller;
use App\Models\Task\Task;
use Illuminate\Http\JsonResponse;

class ViewTaskController extends Controller
{
    public function view(Task $task): JsonResponse
    {
        return response()->json($task);
    }
}
