<?php

declare(strict_types=1);

namespace Feature\Task;

use App\Models\Task\Status;
use App\Models\Task\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListTaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_task_listing(): void
    {
        Task::factory()->scheduled()->create();

        $response = $this->getJson(route('tasks.list'));

        $response->assertStatus(200);
    }

    public function test_it_lists_only_incomplete_tasks(): void
    {
        Task::factory()->scheduled()->create();
        Task::factory()->inProgress()->create();
        Task::factory()->completed()->create();

        $response = $this->getJson(route('tasks.list'));

        $response->assertStatus(200);
        $response->assertJsonCount(2);
        $response->assertJsonFragment(['status' => Status::SCHEDULED->value]);
        $response->assertJsonFragment(['status' => Status::IN_PROGRESS->value]);
        $response->assertJsonMissing(['status' => Status::COMPLETED->value]);
    }
}
