<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParallaxContextSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('parallax_context')->insert([
            'header_big' => 'Sepette %50 İndirim',
            'header_small' => 'Quisque nec ex non est sodales interdum ut at nulla.',
            'header_medium' => 'Yaz İndirimi',
            'button_name' => 'Alışverişe Başla',
            'image' => 'front/img/home/parallax-bg.png',
        ]);
    }
}
