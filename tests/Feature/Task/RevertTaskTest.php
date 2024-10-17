<?php

namespace Feature\Task;

use App\Models\Task\Status;
use App\Models\Task\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RevertTaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_only_complete_task_can_be_reverted(): void
    {
        $task = Task::factory()->scheduled()->create();

        $response = $this->postJson(route('tasks.revert', $task));

        $response->assertStatus(400);
    }

    public function test_task_complete(): void
    {
        $task = Task::factory()->completed()->create();

        $response = $this->postJson(route('tasks.revert', $task));

        $response->assertStatus(201);

        $task->refresh();
        $this->assertNull($task->scheduled);
        $this->assertEquals(Status::IN_PROGRESS, $task->status);
    }
}
