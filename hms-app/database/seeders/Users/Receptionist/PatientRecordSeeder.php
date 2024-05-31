<?php

namespace Database\Seeders\Users\Receptionist;

use App\Models\Users\Receptionist\PatientRecord;
use Illuminate\Database\Seeder;

class PatientRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PatientRecord::factory()
            ->count(10)
            ->create();
    }
}
