<?php

declare(strict_types=1);

namespace App\Http\Controllers\Task\Create;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateTaskController extends Controller
{
    public function create(Request $request): JsonResponse
    {
        $query = new CreateTaskQuery(
            $request->input('title'),
            $request->input('description'),
            $request->input('scheduled')
        );

        $task = CreateTaskQueryHandler::handle($query);

        return response()->json($task, 201);
    }
}
