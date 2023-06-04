<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Check>
 */
class CheckFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $statusCode = fake()->randomElement([200, 400, 404, 500]);

        return [
            'response_code' => $statusCode,
            'response_body' => $statusCode !== 200 ? fake()->randomHtml : null,
        ];
    }
}
