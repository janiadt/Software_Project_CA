<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ErrorReport>
 */
class ErrorReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $severities = ['Minimal Error', 'Minor Error', 'Medium Error', 'Major Error', 'Fatal Error'];
        return [
            'title' => $this->faker->sentence(3),
            'body' => $this->faker->sentence(70),
            'severity' => $this->faker->randomElement($severities),

            'user_id' => $this->faker->numberBetween(1, 20)
        ];
    }
}
