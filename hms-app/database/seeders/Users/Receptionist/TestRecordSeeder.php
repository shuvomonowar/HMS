<?php

namespace Database\Seeders\Users\Receptionist;

use App\Models\Users\Receptionist\TestRecord;
use Illuminate\Database\Seeder;

class TestRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TestRecord::factory()
            ->count(10)
            ->create();
    }
}
