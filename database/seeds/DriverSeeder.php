<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('drivers')->insert([
            [
                'inDate' => Carbon::parse('2000-01-01'),
                'outDate' => Carbon::parse('2000-02-01'),
                'user_id' => 1,
                'vehicle_id' => 1
            ],
            [
                'inDate' => Carbon::parse('2000-01-01'),
                'outDate' => Carbon::parse('2000-02-01'),
                'user_id' => 1,
                'vehicle_id' => 2
            ],
            [
                'inDate' => Carbon::parse('2000-01-01'),
                'outDate' => Carbon::parse('2000-02-01'),
                'user_id' => 2,
                'vehicle_id' => 1
            ]
        ]);
    }
}
