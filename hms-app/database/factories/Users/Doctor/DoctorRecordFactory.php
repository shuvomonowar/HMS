<?php

namespace Database\Factories\Users\Doctor;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Model>
 */
class DoctorRecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'specialization' => $this->faker->randomElement(['Cardiology', 'Dermatology', 'Neurology', 'Orthopedics', 'Pediatrics']),
            'qualification' => $this->faker->realText(20, 2),
            'phone_number' => $this->faker->unique()->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
        ];
    }
}
