<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        $categories = [
            'Shonen', 'Shojo', 'Seinen', 'Josei',
            'Isekai', 'Mecha', 'Slice of Life', 'Horror',
            'Romance', 'Fantasy'
        ];

        return [
            'name' => fake()->unique()->randomElement($categories),
            'description' => fake()->paragraph(),
        ];
    }
}