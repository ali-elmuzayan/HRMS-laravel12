<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'job_title' => $this->faker->jobTitle(),
            'employee_code' => 'EMP-'.strtoupper($this->faker->bothify('??###')),
            'joining_date' => $this->faker->dateTimeBetween('-5 years', 'now')->format('Y-m-d'),
            'birth_date' => $this->faker->dateTimeBetween('-50 years', '-20 years')->format('Y-m-d'),
            'gender' => Arr::random(['Male', 'Female', 'Other']),
            'national_id' => $this->faker->numerify('###########'), // 11-digit number
            'salary' => $this->faker->randomFloat(2, 20000, 150000),
            'contract_type' => Arr::random(['Full-time', 'Part-time', 'Contract', 'Temporary']),
            'work_shift' => Arr::random(['Morning', 'Evening', 'Night', 'Rotating']),
            'address' => $this->faker->address(),
            'notes' => $this->faker->boolean(30) ? $this->faker->sentence(10) : null,
            'user_id' => null, // Will be set when creating relationships
            'tenant_id' => null, // Will be set when creating relationships
        ];

    }

     public function fullTime(): static
    {
        return $this->state([
            'contract_type' => 'Full-time',
            'salary' => $this->faker->randomFloat(2, 40000, 150000),
        ]);
    }

    public function partTime(): static
    {
        return $this->state([
            'contract_type' => 'Part-time',
            'salary' => $this->faker->randomFloat(2, 20000, 40000),
        ]);
    }

    // State method for specific work shifts
    public function morningShift(): static
    {
        return $this->state([
            'work_shift' => 'Morning',
        ]);
    }

    public function nightShift(): static
    {
        return $this->state([
            'work_shift' => 'Night',
            'salary' => $this->faker->randomFloat(2, 50000, 180000), // Night shift premium
        ]);
    }
}
