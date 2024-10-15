<?php

declare(strict_types=1);

namespace App\Http\Controllers\Task\List;

use App\Models\Task\Task;
use Illuminate\Database\Eloquent\Collection;

class ListTaskQueryHandler
{
    public static function handle(ListTaskQuery $query): Collection
    {
        return Task::whereIn('status', ['scheduled', 'in_progress'])->get();
    }
}
