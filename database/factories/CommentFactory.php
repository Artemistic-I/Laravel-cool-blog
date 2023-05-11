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
            "created_at" => fake()->dateTimeBetween('-1 month', 'now'),
            "updated_at" => fake()->dateTimeBetween('-1 month', 'now'),
            "body" => fake()->realText(fake()->numberBetween(10, 200),2),
            "post_id" => \App\Models\Post::inRandomOrder()->first()->id,
            "user_id" => \App\Models\User::inRandomOrder()->first()->id,
        ];
    }
}
