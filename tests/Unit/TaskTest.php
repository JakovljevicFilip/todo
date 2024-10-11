<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Models\Task\Status;
use App\Models\Task\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;
    private Status $status = Status::SCHEDULED;

    public function test_task_creation(): void
    {
        $task = Task::create([
            'id' => (string) Str::uuid(),
            'title' => 'Sample Task',
            'description' => 'This is a sample description',
            'scheduled' => now()->addDay(),
            'status' => $this->status,
        ]);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => 'Sample Task',
            'status' => $this->status,
        ]);
    }

    public function test_task_creation_with_nullable_fields(): void
    {
        $task = Task::create([
            'id' => (string) Str::uuid(),
            'title' => 'Another Task',
            'status' => $this->status,
        ]);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => 'Another Task',
            'status' => $this->status,
            'description' => null,
            'scheduled' => null,
        ]);
    }
}
