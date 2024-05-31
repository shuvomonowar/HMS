<?php

namespace Database\Seeders\Users\Doctor;

use App\Models\Users\Doctor\DoctorRecord;
use Illuminate\Database\Seeder;

class DoctorRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DoctorRecord::factory()
            ->count(10)
            ->create();
    }
}
