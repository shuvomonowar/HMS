<?php

namespace Database\Factories\Admin\System;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends Factory<Model>
 */
class SystemAdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $email = 'admin@gmail.com';
        $username = 'admin';
        $password = 'password';

        return [
            'email' => $email,
            'username' => $username,
            'password' => Hash::make($password)
        ];
    }
}
