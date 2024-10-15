<?php

namespace Database\Seeders;

use App\Models\Task\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run()
    {
        Task::factory()->count(5)->scheduled()->create();
        Task::factory()->count(5)->inProgress()->create();
        Task::factory()->count(5)->completed()->create();
    }

}
