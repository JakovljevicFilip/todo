<?php

namespace Database\Factories;

use App\Models\Task\Status;
use App\Models\Task\Task;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        return [
            'id' => (string) Str::uuid(),
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
        ];
    }

    public function scheduled(): Factory
    {
        return $this->state(fn (array $attributes) => [
            'scheduled' => $this->faker->dateTimeBetween('now', '+1 week'),
            'status' => Status::SCHEDULED->value,
        ]);
    }

    public function inProgress(): Factory
    {
        return $this->state(fn (array $attributes) => [
            'status' => Status::IN_PROGRESS->value,
        ]);
    }

    public function completed(): Factory
    {
        return $this->state(fn (array $attributes) => [
            'scheduled' => $this->faker->dateTimeBetween('-1 week'),
            'status' => Status::COMPLETED->value,
        ]);
    }
}
