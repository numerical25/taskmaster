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
            ['name' => 'Task 1', 'priority' => 'High'],
            ['name' => 'Task 2', 'priority' => 'Medium'],
            ['name' => 'Task 3', 'priority' => 'Low'],
        ];

        foreach ($tasks as $task) {
            Task::create($task);
        }
    }
}
