<?php

namespace Database\Seeders;

use App\Models\Task\Status;
use Illuminate\Database\Seeder;
use App\Models\Task\Task;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define custom task data for each status
        $scheduledTasks = [
            ['title' => 'Visit dentist', 'description' => 'Due by Monday'],
            ['title' => 'Buy groceries', 'description' => 'Get vegetables, fruits, and milk'],
            ['title' => 'Prepare for meeting', 'description' => 'Review the report before Friday'],
            ['title' => 'Gym workout', 'description' => 'Leg day on Tuesday'],
            ['title' => 'Complete project report', 'description' => 'Submit by end of week'],
            ['title' => 'Call the plumber', 'description' => 'Fix the sink before Thursday'],
            ['title' => 'Schedule car maintenance', 'description' => 'Service due next Wednesday'],
            ['title' => 'Renew gym membership', 'description' => 'Due by next month'],
            ['title' => 'Buy a birthday gift', 'description' => 'Need to purchase by Saturday'],
            ['title' => 'Organize desk', 'description' => 'Organize work desk on Wednesday'],
        ];

        $inProgressTasks = [
            ['title' => 'Study for exam', 'description' => 'Focus on chapters 5-7'],
            ['title' => 'Clean the garage', 'description' => 'Finish by this evening'],
            ['title' => 'Fix the garden fence', 'description' => 'Ongoing repairs'],
            ['title' => 'Prepare presentation slides', 'description' => 'Slide deck for the big meeting'],
            ['title' => 'Write blog post', 'description' => 'Complete the draft'],
            ['title' => 'Plan weekend trip', 'description' => 'Work on the itinerary'],
            ['title' => 'Fix broken door lock', 'description' => 'Repair ongoing'],
            ['title' => 'Study new framework', 'description' => 'Reading through docs'],
            ['title' => 'Prepare dinner party menu', 'description' => 'Testing recipes'],
            ['title' => 'Update website design', 'description' => 'In progress'],
        ];

        $completedTasks = [
            ['title' => 'Finish reading novel', 'description' => 'Completed on Sunday'],
            ['title' => 'Submit tax documents', 'description' => 'Submitted last week'],
            ['title' => 'Fix laptop', 'description' => 'Repaired successfully'],
            ['title' => 'Grocery shopping', 'description' => 'Completed last weekend'],
            ['title' => 'Organize the event', 'description' => 'Event was a success'],
            ['title' => 'Plan family vacation', 'description' => 'All arrangements done'],
            ['title' => 'Complete marathon', 'description' => 'Completed successfully'],
            ['title' => 'Donate old clothes', 'description' => 'Donated to charity'],
            ['title' => 'Paint the house', 'description' => 'Painting finished last month'],
            ['title' => 'Repair the fence', 'description' => 'Repair completed'],
            ['title' => 'Write book chapter', 'description' => 'First draft done'],
            ['title' => 'Publish article', 'description' => 'Published in journal'],
            ['title' => 'Host dinner party', 'description' => 'Dinner party was a hit'],
            ['title' => 'Renew driver’s license', 'description' => 'Renewal completed'],
            ['title' => 'Register for conference', 'description' => 'Registration done'],
        ];

        foreach ($scheduledTasks as $index => $task) {
            Task::create([
                'id' => (string) Str::uuid(),
                'title' => $task['title'],
                'description' => $task['description'],
                'scheduled' => Carbon::now()->addDays(rand(1, 7)),
                'status' => Status::SCHEDULED,
            ]);
        }

        foreach ($inProgressTasks as $index => $task) {
            Task::create([
                'id' => (string) Str::uuid(),
                'title' => $task['title'],
                'description' => $task['description'],
                'scheduled' => null,
                'status' => Status::IN_PROGRESS,
            ]);
        }

        foreach ($completedTasks as $index => $task) {
            Task::create([
                'id' => (string) Str::uuid(),
                'title' => $task['title'],
                'description' => $task['description'],
                'scheduled' => Carbon::now()->subDays(rand(1, 7)),
                'status' => Status::COMPLETED,
            ]);
        }
    }
}
