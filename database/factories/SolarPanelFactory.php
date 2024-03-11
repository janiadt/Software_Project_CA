<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SolarPanel>
 */
class SolarPanelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number' => $this->faker->numberBetween(1,10),
            'light_level' => $this->faker->numberBetween(1,300),
            'battery' => $this->faker->numberBetween(1,100),
            'production' => $this->faker->numberBetween(1,3000),
            'ambient_temperature' => $this->faker->numberBetween(-10,100),
            'humidity' => $this->faker->numberBetween(1,200),
            'panel_temperature' => $this->faker->numberBetween(-10,400),

            'company_id' => $this->faker->numberBetween(1,20),
            'user_id' => $this->faker->numberBetween(1, 20)
        ];
    }
}
