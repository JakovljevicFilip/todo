<?php

declare(strict_types=1);

namespace Feature\Task;

use App\Models\Task\Status;
use App\Models\Task\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChangeTaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_title_is_required(): void
    {
        $task = Task::factory()->scheduled()->create();
        $response = $this->postJson(route('tasks.change', $task), [
            'scheduled' => now()->addDay()->toDateString(),
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['title']);
    }

    public function test_date_has_to_be_in_correct_format(): void
    {
        $task = Task::factory()->scheduled()->create();
        $response = $this->postJson(route('tasks.change', $task), [
            'title' => 'Sample Task',
            'scheduled' => 'invalid-date',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['scheduled']);
    }

    public function test_task_cannot_be_scheduled_in_the_past(): void
    {
        $task = Task::factory()->scheduled()->create();
        $response = $this->postJson(route('tasks.change', $task), [
            'title' => 'Sample Task',
            'scheduled' => now()->subDay()->toDateString(),
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['scheduled']);
    }

    public function test_change_task(): void
    {
        $task = Task::factory()->scheduled()->create();
        $date = rand(0, 1) ? now()->addDay() : null;

        $response = $this->postJson(route('tasks.change', $task), [
            'title' => 'New title',
            'description' => 'New description',
            'scheduled' => $date?->toDateString(),
        ]);

        $response->assertStatus(201);
        $task->refresh();

        $this->assertEquals('New title', $task->title);
        $this->assertEquals('New description', $task->description);
        $this->assertEquals($date?->toDateString(), $task->scheduled?->toDateString());
        $this->assertEquals($date ? Status::SCHEDULED : Status::IN_PROGRESS, $task->status);
    }
}
