<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = [
            ['name' => 'Task 1', 'priority' => 'High',  'priority_order' => 1],
            ['name' => 'Task 2', 'priority' => 'Medium', 'priority_order' => 2],
            ['name' => 'Task 3', 'priority' => 'Low' ,'priority_order' => 3],
        ];

        foreach ($tasks as $task) {
            Task::create($task);
        }
    }
}
