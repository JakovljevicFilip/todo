<?php

declare(strict_types=1);

namespace App\Http\Controllers\Task\Delete;

use App\Http\Controllers\Controller;
use App\Models\Task\Status;
use App\Models\Task\Task;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DeleteTaskController extends Controller
{
    public function delete(Task $task): JsonResponse
    {
        if ($task->status === Status::COMPLETED) {
            abort(response()->json([
                'error' => 'Cannot delete a completed task.'
            ], Response::HTTP_BAD_REQUEST));
        }

        $task->delete();
        return response()->json(null, 201);
    }
}
