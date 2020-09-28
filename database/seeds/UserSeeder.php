<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'office_location' => 'mumbai',
            'contact_number' => '9999999999',
            'salary' => '10000',
            'role' => '1',
            'status' => '1',
            'ip' => '103.87.31.196',
            'cordinate_country' => 'india',
            'role_name' => 'HR',
            'password' => Hash::make('password'),
        ]);
    }
}
