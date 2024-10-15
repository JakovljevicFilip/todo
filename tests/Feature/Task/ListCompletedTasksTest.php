<?php

namespace Feature\Task;

use App\Models\Task\Status;
use App\Models\Task\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListCompletedTasksTest extends TestCase
{
    use RefreshDatabase;

    public function test_task_listing(): void
    {
        $response = $this->getJson(route('tasks.list_completed'));

        $response->assertStatus(200);
    }

    public function test_list_complete_tasks_lists_only_complete_tasks(): void
    {
        Task::factory()->completed()->create();
        Task::factory()->scheduled()->create();
        Task::factory()->inProgress()->create();

        $response = $this->getJson(route('tasks.list_completed'));

        $response->assertStatus(200);

        $response->assertJsonCount(1);
        $response->assertJsonFragment(['status' => Status::COMPLETED->value]);
        $response->assertJsonMissing(['status' => Status::SCHEDULED->value]);
        $response->assertJsonMissing(['status' => Status::IN_PROGRESS->value]);
    }
}
