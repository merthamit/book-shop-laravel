<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FooterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('footer')->insert([
            'mission' => "So seed seed green that winged cattle in. Gathering thing made fly you're no divided deep moved us lan Gathering thing us land years living.",
            'phone' => '312 450 12 12',
            'address' => '30, Messi Sokak, Barcelona',
            'email' => 'test@gmail.com',
        ]);
    }
}
