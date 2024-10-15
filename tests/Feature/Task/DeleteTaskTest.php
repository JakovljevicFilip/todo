<?php

namespace Feature\Task;

use App\Models\Task\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteTaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_complete_task_cannot_be_deleted(): void
    {
        $task = Task::factory()->completed()->create();

        $response = $this->postJson(route('tasks.delete', $task));

        $response->assertStatus(400);
    }

    public function test_task_delete(): void
    {
        $task = Task::factory()->scheduled()->create();

        $response = $this->postJson(route('tasks.delete', $task));

        $response->assertStatus(201);

        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id,
        ]);
    }
}
