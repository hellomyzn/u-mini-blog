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
    public function definition()
    {
        $created_at = $this->faker->dateTimeBetween('-10days', '-1days');
        $updated_at = $this->faker->dateTimeBetween($created_at, '0days');
        return [
            'user_id' => User::factory(),
            'is_public' => $this->faker->randomElement([1,1,1,1,0]),
            'title' => $this->faker->realText(20),
            'body' => $this->faker->realText(100),
            'created_at' => $created_at,
            'updated_at' => $updated_at
        ];
    }
}
