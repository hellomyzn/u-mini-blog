<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Blog;
use App\Models\User;

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
    public function definition()
    {
        return [
            'blog_id' => Blog::factory(),
            'user_id' => User::factory(),
            'body' => $this->faker->realText(100),
            'created_at' => $this->faker->dateTimeBetween('-10days', '0days'),
        ];
    }
}
