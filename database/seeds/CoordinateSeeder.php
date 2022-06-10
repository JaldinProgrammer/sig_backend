<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoordinateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('coordinates')->insert([
            [
                'latitude' => '12.345535345634514',
                'longitude' => '-93.2342565765613',
                'bus_id' => 1,
                'coming_back' => false
            ],
        ]);
    }
}
