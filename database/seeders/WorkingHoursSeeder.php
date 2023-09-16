<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkingHoursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('working_hours')->truncate();

        // Insert working hours
        DB::table('working_hours')->insert([
            ['start_time' => '11:00', 'end_time' => '23:00'],
        ]);
    }
}
