<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Str;


class UserFactory extends Factory
{

    

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('password'), // default password
            'role' => $this->faker->randomElement(['resident', 'collector', 'admin']),
            'phone' => $this->faker->phoneNumber(),
            'remember_token' => Str::random(10),
        ];
    }
}

