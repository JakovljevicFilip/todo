<?php

namespace Feature\Task;

use App\Models\Task\Task;
use Tests\TestCase;

class ViewTaskTest extends TestCase
{
    public function test_task_view(): void
    {
        $task = Task::factory()->scheduled()->create();

        $response = $this->getJson(route('tasks.view', $task));

        $response->assertStatus(200);

        $this->assertEquals($task->id, $response->getData()->id);
        $this->assertEquals($task->title, $response->getData()->title);
        $this->assertEquals($task->description, $response->getData()->description);
        $this->assertEquals($task->status->value, $response->getData()->status);
    }
}
