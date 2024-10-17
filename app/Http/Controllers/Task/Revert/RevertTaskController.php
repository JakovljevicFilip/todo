<?php

declare(strict_types=1);

namespace App\Http\Controllers\Task\Revert;

use App\Http\Controllers\Controller;
use App\Models\Task\Status;
use App\Models\Task\Task;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class RevertTaskController extends Controller
{
    public function revert(Task $task): JsonResponse
    {
        if ($task->status !== Status::COMPLETED) {
            abort(response()->json([
                'error' => 'Cannot a revert a non-complete task.'
            ], Response::HTTP_BAD_REQUEST));
        }

        $task->scheduled = null;
        $task->status = Status::IN_PROGRESS;
        $task->save();

        return response()->json(null, 201);
    }
}
