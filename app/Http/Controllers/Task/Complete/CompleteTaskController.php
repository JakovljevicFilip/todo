<?php

declare(strict_types=1);

namespace App\Http\Controllers\Task\Complete;

use App\Http\Controllers\Controller;
use App\Models\Task\Status;
use App\Models\Task\Task;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CompleteTaskController extends Controller
{
    public function complete(Task $task): JsonResponse
    {
        if ($task->status === Status::COMPLETED) {
            abort(response()->json([
                'error' => 'Cannot complete a completed task.'
            ], Response::HTTP_BAD_REQUEST));
        }

        $task->status = Status::COMPLETED;
        $task->save();

        return response()->json(null, 201);
    }
}
