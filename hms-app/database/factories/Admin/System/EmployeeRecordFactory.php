<?php

namespace Database\Factories\Admin\System;

use App\Models\Admin\System\EmployeeRecord;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends Factory<EmployeeRecord>
 */
class EmployeeRecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $departmentDesignationMap = [
            'Doctor' => 'Doctor',
            'Nurse' => 'Nurse',
            'Account' => 'Accountant',
            'Receptionist' => 'Receptionist',
            'Laboratory & Diagnostic Technician' => [
                'Laboratory Technician',
                'Diagnostic Technician'
            ],
        ];

        $department = $this->faker->randomElement(array_keys($departmentDesignationMap));
        $designation = is_array($departmentDesignationMap[$department])
            ? $this->faker->randomElement($departmentDesignationMap[$department])
            : $departmentDesignationMap[$department];

        return [
            'first_name' => $this->faker->name,
            'last_name' => $this->faker->name,
            'username' => strtolower(str_replace(' ', '', $this->faker->unique()->name)),
            'department' => $department,
            'designation' => $designation,
            'salary' => $this->faker->randomNumber(5),
            'hire_date' => $this->faker->dateTimeThisDecade(),
            'employment_type' => $this->faker->randomElement(['Full Time', 'Part Time']),
            'gender' => $this->faker->randomElement(['Male', 'Female']),
            'birth_date' => $this->faker->dateTimeBetween('-60 years', '-18 years'),
            'address' => $this->faker->address,
            'nid' => $this->faker->unique()->numerify('##########'),
            'phone' => $this->faker->unique()->numerify('###########'),
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password'),
        ];
    }
}
