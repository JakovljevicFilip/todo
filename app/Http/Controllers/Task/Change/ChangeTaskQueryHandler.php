<?php

declare(strict_types=1);

namespace App\Http\Controllers\Task\Change;

use App\Models\Task\Status;
use App\Models\Task\Task;

class ChangeTaskQueryHandler
{
    public static function handle(Task $task, ChangeTaskQuery $query): void
    {
        $task->update([
            'title' => $query->getTitle(),
            'description' => $query->getDescription(),
            'scheduled' => $query->getScheduled(),
            'status' => $query->getStatus()
        ]);
    }
}
