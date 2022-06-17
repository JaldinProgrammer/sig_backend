<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Carlos Isaac Jaldin Benavides',
                'email' => 'jaldin@gmail.com',
                'password' => Hash::make('123'),
                'admin' => false,
                'license_category_id' => 1
            ],
            [
                'name' => 'Valeria Coronado',
                'email' => 'vale@gmail.com',
                'password' => Hash::make('123'),
                'admin' => false,
                'license_category_id' => 1
            ],
            [
                'name' => 'Administrador',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123'),
                'admin' => true,
                'license_category_id' => 1
            ],
        ]);
    }
}
