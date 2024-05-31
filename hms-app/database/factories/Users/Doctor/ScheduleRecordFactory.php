<?php

namespace Database\Factories\Users\Doctor;

use App\Models\Model;
use App\Models\Users\Doctor\DoctorRecord;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;  // Include Carbon for date manipulation

/**
 * @extends Factory<Model>
 */
class ScheduleRecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $doctor = DoctorRecord::factory()->create();
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

        $start_time = $this->faker->time('H:i:s', strtotime('09:00:00'), strtotime('17:00:00'));
        $end_time = date('H:i:s', strtotime($start_time . ' +30 minutes'));

        return [
            'doctor_id' => $doctor->id,
            'schedule_day' => 'Saturday',
            'start_time' => $start_time,
            'end_time' => $end_time,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // Generate records for two distinct days with two time slots each
        /*$records = [];
        for ($i = 0; $i < 2; $i++) {
            $day = $this->faker->randomElement($days);  // Pick a random day

            // Generate two random non-overlapping time slots for the day
            $timeSlots = $this->generateTimeSlots();
            foreach ($timeSlots as $timeSlot) {
                $records[] = [
                    'doctor_id' => $doctor->id,
                    'schedule_day' => $day,
                    'start_time' => $timeSlot['start'],
                    'end_time' => $timeSlot['end'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        return $records;  // Return an array of schedule records*/
    }

    /*private function generateTimeSlots(): array
    {
        // Define available time slots (replace with your desired times if needed)
        $availableSlots = [
            ['start' => '09:00:00', 'end' => '09:30:00'],
            ['start' => '10:00:00', 'end' => '10:30:00'],
            ['start' => '14:00:00', 'end' => '14:30:00'],
            ['start' => '15:00:00', 'end' => '15:30:00'],
        ];

        // Shuffle the slots and pick the first two (assuming no overlap)
        shuffle($availableSlots);
        return array_slice($availableSlots, 0, 2);
    }*/
}
