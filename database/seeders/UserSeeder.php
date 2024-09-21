<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Mert',
            'email' => 'merthamit@hotmail.com',
            'password' => bcrypt(123456),
            'usertype' => 'user',
        ]);
        DB::table('users')->insert([
            'name' => 'Mert',
            'email' => 'merthamit11@gmail.com',
            'password' => bcrypt(123456),
            'usertype' => 'admin',
        ]);
    }
}
