<?php

namespace Database\Seeders\Users\Receptionist;

use App\Models\Users\Receptionist\AppointmentRecord;
use Illuminate\Database\Seeder;

class AppointmentRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AppointmentRecord::factory()
            ->count(10)
            ->create();
    }
}
