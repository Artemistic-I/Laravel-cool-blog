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
            "title" => fake()->realText($maxNbChars = 100, $indexSize = 2),
            "content" => fake()->realText($maxNbChars = 1000, $indexSize = 2),
            "created_at" => fake()->dateTimeBetween('-1 month', 'now'),
            "updated_at" => fake()->dateTimeBetween('-1 month', 'now'),
            "likes_count" => $likes = fake()->numberBetween(0, \App\Models\User::get()->count()),
            "dislikes_count" => $dislikes = fake()->numberBetween(0, \App\Models\User::get()->count() - $likes),
            "views_count" => fake()->numberBetween($likes + $dislikes, \App\Models\User::get()->count()),
            "user_id" => \App\Models\User::inRandomOrder()->first()->id,
        ];
    }
}
