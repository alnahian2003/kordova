<?php

namespace Database\Factories;

use App\Enums\EndpointFrequencyEnums;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Endpoint>
 */
class EndpointFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $location = fake()->randomElement([
            '/',
            '/docs',
            '/about',
            '/404',
            '/rickroll',
            '/alnahian2003',
            '/simply-awesome',
            '/fishy-website',
        ]);

        $frequency = fake()->randomElement([
            EndpointFrequencyEnums::ONE_MINUTE->value,
            EndpointFrequencyEnums::THREE_MINUTE->value,
            EndpointFrequencyEnums::FIVE_MINUTE->value,
            EndpointFrequencyEnums::ONE_HOUR->value,
        ]);

        return [
            'location'   => $location,
            'frequency'  => $frequency,
            'next_check' => now()->addSeconds($frequency),
        ];
    }
}
