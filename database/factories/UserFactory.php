<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition()
    {
         // Get or create a role if none exists
        $role = Role::inRandomOrder()->first() ?? Role::factory()->create();

        return [
            // NO manual ID assignment
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => $this->faker->optional(70)->dateTimeBetween('-1 year', 'now'),
            'phone' => $this->faker->optional()->phoneNumber(),
            'avatar' => $this->faker->optional()->imageUrl(100, 100, 'people'),
            'password' => Hash::make('password'),
            'role_id' => Role::inRandomOrder()->first()->id,
            'is_active' => $this->faker->boolean(90),
            'remember_token' => Str::random(10),
        ];
    }

    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
