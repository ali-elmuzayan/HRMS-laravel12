<?php

namespace Database\Factories;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
     public function definition()
    {
         return [
            'name' => $this->faker->unique()->randomElement(['admin', 'manager', 'employee', 'editor']),
            'description' => $this->faker->sentence(),
            'tenant_id' => Tenant::inRandomOrder()->first()?->id ?? Tenant::factory()->create()->id,
        ];
    }
}
