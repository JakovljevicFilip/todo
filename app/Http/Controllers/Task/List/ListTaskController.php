<?php

declare(strict_types=1);

namespace App\Http\Controllers\Task\List;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class ListTaskController extends Controller
{
    public function list(): JsonResponse
    {
        $query = new ListTaskQuery();

        $tasks = ListTaskQueryHandler::handle($query);

        return response()->json($tasks);
    }
}
