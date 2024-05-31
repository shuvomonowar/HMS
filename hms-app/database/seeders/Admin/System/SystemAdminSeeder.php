<?php

namespace Database\Seeders\Admin\System;

use App\Models\Admin\System\SystemAdmin;
use Illuminate\Database\Seeder;

class SystemAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SystemAdmin::factory()
            ->count(1)
            ->create();
    }
}
