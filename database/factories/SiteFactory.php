<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Site>
 */
class SiteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'scheme' => fake()->randomElement(['http', 'https']),
            'domain' => fake()->randomElement([
                'laravel.com',
                'tailwindcss.com',
                'varve.netlify.app',
                'twitter.com',
                'facebook.com',
            ]),
        ];
    }
}
