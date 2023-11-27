<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::orderBy('id')->first();
        return [
            //
            'owner_id'=> $user->id,
            'title' => $this->faker->title,
            'content' => $this->faker->text()
        ];
    }
}
