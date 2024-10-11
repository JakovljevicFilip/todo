<?php

declare(strict_types=1);

namespace App\Models\Task;

enum Status: string
{
    case SCHEDULED = 'scheduled';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';
}
