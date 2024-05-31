<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Users\Doctor\ScheduleRecord;
use Database\Factories\Admin\System\EmployeeRecordFactory;
use Database\Seeders\Admin\System\EmployeeRecordSeeder;
use Database\Seeders\Admin\System\SystemAdminSeeder;
use Database\Seeders\Users\Doctor\DoctorRecordSeeder;
use Database\Seeders\Users\Doctor\ScheduleRecordSeeder;
use Database\Seeders\Users\Receptionist\AppointmentRecordSeeder;
use Database\Seeders\Users\Receptionist\PatientRecordSeeder;
use Database\Seeders\Users\Receptionist\TestRecordSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\Users::factory(10)->create();

        // \App\Models\Users::factory()->create([
        //     'name' => 'Test Users',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            // SystemAdminSeeder::class
            // EmployeeRecordSeeder::class
            // PatientRecordSeeder::class
            // AppointmentRecordSeeder::class
            // DoctorRecordSeeder::class
            ScheduleRecordSeeder::class
            // TestRecordSeeder::class
        ]);
    }
}
