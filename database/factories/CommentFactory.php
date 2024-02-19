<?php

namespace Database\Factories;

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
        return [
            'user_id' => fake()->numberBetween(1, 5),
            'post_id' => 1,
            'parent_id' => fake()->numberBetween(0, 2),
            'mention_id' => fake()->numberBetween(1, 5),
            'title' => fake()->sentence(),
            'published' => 1,
            'created_at' => now(),
            'updated_at' => fake()->dateTimeBetween('-2 years', 'now'),
            'published_at' => fake()->dateTimeBetween('-2 years', 'now'),
            'content' => fake()->realText($maxNbChars = 200, $indexSize = 2)
        ];
    }
}
