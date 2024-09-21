<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(BookSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(HeroContextSeeder::class);
        $this->call(ParallaxContextSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(FooterSeeder::class);
    }
}
