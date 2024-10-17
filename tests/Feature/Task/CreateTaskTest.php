<?php

declare(strict_types=1);

namespace Feature\Task;

use App\Models\Task\Status;
use App\Models\Task\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateTaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_title_is_required(): void
    {
        $response = $this->postJson(route('tasks.create'), [
            'scheduled' => now()->addDay()->toDateString(),
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['title']);
    }

    public function test_date_has_to_be_in_correct_format(): void
    {
        $response = $this->postJson(route('tasks.create'), [
            'title' => 'Sample Task',
            'scheduled' => 'invalid-date',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['scheduled']);
    }

    public function test_task_cannot_be_scheduled_in_the_past(): void
    {
        $response = $this->postJson(route('tasks.create'), [
            'title' => 'Sample Task',
            'scheduled' => now()->subDay()->toDateString(),
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['scheduled']);
    }

    public function test_create_task(): void
    {
        $response = $this->postJson(route('tasks.create'), [
            'title' => 'Sample Task',
            'scheduled' => now()->addDay()->toDateString(),
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('tasks', [
            'title' => 'Sample Task',
            'status' => Status::SCHEDULED->value,
        ]);
    }

    public function test_created_task_with_a_date_should_have_status_scheduled(): void
    {
        $response = $this->postJson(route('tasks.create'), [
            'title' => 'Sample Task',
            'scheduled' => now()->addDay()->toDateString(),
        ]);

        $response->assertStatus(201);
        $task = Task::first();

        $this->assertEquals(Status::SCHEDULED, $task->status);
    }

    public function test_created_task_without_a_date_should_have_status_in_progress(): void
    {
        $response = $this->postJson(route('tasks.create'), [
            'title' => 'Sample Task',
            'scheduled' => null,
        ]);

        $response->assertStatus(201);
        $task = Task::first();

        $this->assertEquals(Status::IN_PROGRESS, $task->status);
    }
}
