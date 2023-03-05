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
            "body" => fake()->sentences(rand(1,4), true),
            "post_id" => \App\Models\Post::inRandomOrder()->first()->id,
        ];
    }
}
