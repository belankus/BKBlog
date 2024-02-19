<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    protected static ?string $password;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->numberBetween(1, 5),
            'category_id' => fake()->numberBetween(1, 3),
            'parent_id' => fake()->numberBetween(0, 9),
            'title' => fake()->sentence(),
            'metaTitle' => fake()->sentence(),
            'slug' => fake()->slug(),
            'summary' => fake()->text(),
            'published' => fake()->boolean(),
            'created_at' => now(),
            'updated_at' => now(),
            'published_at' => fake()->dateTimeBetween('-2 years', 'now'),
            'image' => null,
            'content' => fake()->paragraphs(10, true)

        ];
    }
}
