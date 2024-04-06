<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

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

        return [
            'author_id' => function () {
                return fake()->randomElement([1, 2]);
            },
            'publisher_id' => function () {
                return 3;
            },
            'title' => fake()->sentence(),
            'content' => fake()->paragraph,
            'published_at' => fake()->time,
            'image' => fake()->imageUrl,
        ];
    }
}
