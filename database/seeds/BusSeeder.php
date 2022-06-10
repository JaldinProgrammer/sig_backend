<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('buses')->insert([
            [
                'id' => 1,
                'color' => 'red',
                'name' => 'lv01'
            ],
            [
                'id' => 2,
                'color' => 'red',
                'name' => 'lv02'
            ],
            [
                'id' => 5,
                'color' => 'red',
                'name' => 'lv05'
            ],
            [
                'id' => 8,
                'color' => 'red',
                'name' => 'lv08'
            ],
            [
                'id' => 9,
                'color' => 'red',
                'name' => 'lv09'
            ],
            [
                'id' => 10,
                'color' => 'red',
                'name' => 'lv010'
            ],
            [
                'id' => 11,
                'color' => 'red',
                'name' => 'lv011'
            ],
            [
                'id' => 16,
                'color' => 'red',
                'name' => 'lv016'
            ],
            [
                'id' => 17,
                'color' => 'red',
                'name' => 'lv017'
            ],
            [
                'id' => 18,
                'color' => 'red',
                'name' => 'lv018'
            ],
        ]);
    }
}
