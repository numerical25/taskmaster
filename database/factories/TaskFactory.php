<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $order = 1;
        return [
            //
            'name' => $this->faker->name,
            'priority' => $this->faker->randomElement(['High', 'Medium', 'Low']),
            'priority_order' => $order++
        ];
    }
}
