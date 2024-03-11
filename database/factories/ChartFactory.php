<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Chart>
 */
class ChartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Array of options
        $types = ['Bar', 'Pie', '100%', 'Line', 'Scatterplot'];
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->sentence(100),
            'type' => $this->faker->randomElement($types),

            'user_id' => $this->faker->numberBetween(1, 20)
        ];
    }
}
