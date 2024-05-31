<?php

namespace Database\Seeders\Users\Doctor;

use Illuminate\Database\Seeder;
use App\Models\Users\Doctor\ScheduleRecord;

class ScheduleRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ScheduleRecord::factory()
            ->count(1)
            ->create();
    }
}
