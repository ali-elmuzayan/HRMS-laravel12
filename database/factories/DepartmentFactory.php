<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Department>
 */

class DepartmentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->Name(),
            'description' => $this->faker->boolean(70) ? $this->faker->sentence(10) : null,
            'max_employees' => $this->faker->boolean(50) ? $this->faker->numberBetween(5, 50) : null,
            'manager_id' => null, // Will be set when creating relationships
            'parent_department_id' => null, // Will be set when hierarchical relationships
            'tenant_id' => null, // Will be set when creating relationships
        ];
    }

    // State method for departments with managers
    public function withManager(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'manager_id' => \App\Models\User::factory()->create()->id,
            ];
        });
    }

    // State method for child departments
    public function withParent(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'parent_department_id' => \App\Models\Department::factory()->create()->id,
            ];
        });
    }

    // State method for specific department types
    public function hr(): static
    {
        return $this->state([
            'name' => 'Human Resources',
            'description' => 'Handles recruitment, employee relations, and benefits',
            'max_employees' => 15,
        ]);
    }

    public function it(): static
    {
        return $this->state([
            'name' => 'Information Technology',
            'description' => 'Manages technology infrastructure and systems',
            'max_employees' => 25,
        ]);
    }

    public function finance(): static
    {
        return $this->state([
            'name' => 'Finance',
            'description' => 'Handles accounting, budgeting, and financial reporting',
            'max_employees' => 10,
        ]);
    }
}
