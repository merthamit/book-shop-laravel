<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HeroContextSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('hero_context')->insert([
            'header_big' => 'Aradığın bütün kitaplar burada',
            'header_small' => 'Quisque nec ex non est sodales interdum ut at nulla. Quisque quis ligula dictum neque pretium pellentesque. Donec a elit eget purus vulputate faucibus. Pellentesque efficitur faucibus nibh, non gravida mi.',
            'header_medium' => 'Kitap okumak harika',
            'button_name' => 'Alışverişe Başla',
        ]);
    }
}
