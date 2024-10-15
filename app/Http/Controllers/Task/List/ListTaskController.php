<?php

declare(strict_types=1);

namespace App\Http\Controllers\Task\List;

use App\Http\Controllers\Controller;
use App\Models\Task\Task;
use Illuminate\Http\JsonResponse;

class ListTaskController extends Controller
{
    public function list(): JsonResponse
    {
        $tasks = Task::whereIn('status', ['scheduled', 'in_progress'])->get();
        return response()->json($tasks);
    }
}
