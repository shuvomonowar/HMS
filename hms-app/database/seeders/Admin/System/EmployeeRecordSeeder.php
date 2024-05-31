<?php

namespace Database\Seeders\Admin\System;

use App\Models\Admin\System\EmployeeRecord;
use Illuminate\Database\Seeder;

class EmployeeRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define the starting ID
        // $startId = 1001;

        // Create 10 records using the factory
        EmployeeRecord::factory()
            ->count(10)
            ->create();
            /*->each(function ($employee, $index) use ($startId) {
                // Increment the ID for each record
                $employee->update(['id' => $startId + $index]);
            });*/
    }
}
