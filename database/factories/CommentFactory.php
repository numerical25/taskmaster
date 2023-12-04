<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomUserId = User::inRandomOrder()->pluck('id')->first();
        $randomContentId = Blog::inRandomOrder()->pluck('id')->first();
        return [
            //
            'owner_id' => $randomUserId,
            'content_id' => $randomContentId,
            'content' => $this->faker->sentence(50, true)
        ];
    }
}
