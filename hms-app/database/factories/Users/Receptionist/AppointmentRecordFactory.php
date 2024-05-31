<?php

namespace Database\Factories\Users\Receptionist;

use App\Models\Users\Receptionist\AppointmentRecord;
use App\Models\Users\Receptionist\PatientRecord;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentRecordFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AppointmentRecord::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $patient = PatientRecord::factory()->create();

        return [
            'patient_id' => $patient->id, // Create a patient record and use its ID
            'appointment_date' => $this->faker->date(),
            'appointment_time' => $this->faker->unique()->time(),
            'reason' => $this->faker->sentence(),
            'doctor_name' => "Dr. " . $this->faker->name,
        ];
    }
}

