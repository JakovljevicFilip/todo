<?php

declare(strict_types=1);

namespace App\Http\Controllers\Task\Create;

use App\Models\Task\Task;

class CreateTaskQueryHandler
{
    public static function handle(CreateTaskQuery $query): Task
    {
        return Task::create([
            'title' => $query->getTitle(),
            'description' => $query->getDescription(),
            'scheduled' => $query->getScheduled(),
        ]);
    }
}
