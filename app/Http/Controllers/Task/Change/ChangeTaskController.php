<?php

declare(strict_types=1);

namespace App\Http\Controllers\Task\Change;

use App\Http\Controllers\Controller;
use App\Models\Task\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ChangeTaskController extends Controller
{
    public function change(Task $task, Request $request): JsonResponse
    {
        $query = new ChangeTaskQuery(
            $request->input('title'),
            $request->input('description'),
            $request->input('scheduled')
        );

        ChangeTaskQueryHandler::handle($task, $query);

        return response()->json($task, 201);
    }
}
