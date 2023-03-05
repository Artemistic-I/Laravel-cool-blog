<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "title" => fake()->sentence(),
            "content" => fake()->paragraphs(rand(3, 6), true),
            "created_at" => fake()->dateTimeBetween('-1 month', 'now'),
            "updated_at" => fake()->dateTimeBetween('-1 month', 'now'),
            "likes_count" => fake()->numberBetween(0, \App\Models\User::get()->count()),
            "dislikes_count" => fake()->numberBetween(0, \App\Models\User::get()->count()),
            "views_count" => fake()->numberBetween(0, \App\Models\User::get()->count()),
            "user_id" => \App\Models\User::inRandomOrder()->first()->id,
        ];
    }
}
