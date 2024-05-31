<?php

namespace Database\Factories\Users\Receptionist;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Users\Receptionist\TestRecord>
 */
class TestRecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $testNames = [
            'Red Blood Cell Count (RBC)',
            'White Blood Cell Count (WBC)',
            'Hemoglobin (HGB)',
            'Hematocrit (HCT)',
            'Platelet Count',
            'Blood Glucose Test (Fasting)',
            'Hemoglobin A1c (HbA1c)',
            'Blood Type Test',
            'Complete Blood Count (CBC)',
            'Basic Metabolic Panel (BMP)',
            'Comprehensive Metabolic Panel (CMP)',
        ];
        $testCategories = ['Hematology', 'Clinical Chemistry', 'Immunohematology'];

        return [
            'test_name' => $this->faker->randomElement($testNames),
            'test_category' => $this->faker->randomElement($testCategories),
            'test_cost' => $this->faker->numberBetween(50, 1000),
        ];
    }
}
