<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tenants>
 */
class TenantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
      return [
            'name' => $this->faker->company(),
            'slug' => $this->faker->unique()->slug(),
            'logo' => $this->faker->optional()->imageUrl(100, 100),
            'plan' => $this->faker->randomElement(['free', 'basic', 'pro', 'enterprise']),
            'is_active' => $this->faker->boolean(90),
        ];
    }
}
