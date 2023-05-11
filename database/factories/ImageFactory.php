<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "url" => fake()->randomElement(['https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSei1F9BG3nXuk_ekPZ8kNl8L_BK9bnBNhIug&usqp=CAU',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQwbLmEyqtpR1zt9-iaPZWDyMuaf3bjpT0Pfw&usqp=CAU',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ7zPa7sFEjfdKWUnHeTdalGkNJ7RSh4h4fCo_C-AJmoaO30ih_Rtx1Sujk8VGxXVbsaD4&usqp=CAU',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT_S_09K6MJxqBMpO5zknsrMBWkNSypBI2lXqykHLn458LH5qLpMzeDCxVxUisyVMIpRWE&usqp=CAU']),
            //fake()->imageUrl(400,300),
            "post_id" => \App\Models\Post::inRandomOrder()->first()->id,
        ];
    }
}
