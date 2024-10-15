<?php

namespace Feature\Task;

use App\Models\Task\Status;
use App\Models\Task\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompleteTaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_already_complete_task_cannot_be_completed_again(): void
    {
        $task = Task::factory()->completed()->create();

        $response = $this->postJson(route('tasks.complete', $task));

        $response->assertStatus(400);
    }

    public function test_task_complete(): void
    {
        $task = Task::factory()->scheduled()->create();

        $response = $this->postJson(route('tasks.complete', $task));

        $response->assertStatus(201);

        $task->refresh();
        $this->assertEquals(Status::COMPLETED, $task->status);
    }
}
