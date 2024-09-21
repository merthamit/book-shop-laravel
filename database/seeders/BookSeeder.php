<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Faker::create();
        for ($i = 0; $i < 10; $i++) {
            $title = $faker->sentence(4);
            DB::table('book')->insert([
                'title' => $title,
                'slug' => str_slug($title),
                'price' => number_format(mt_rand(0, 100) + mt_rand() / mt_getrandmax(), 2),
                'category_id' => random_int(1, 35),
                'page_count' => random_int(100, 350),
                'release_date' => random_int(1900, 2024),
                'stock' => random_int(0, 10),
                'language' => 'Türkçe',
                'image' => $faker->imageUrl($width = 250, $height = 250),
                'author' => $faker->name(),
                'content' => $faker->sentence(250),
                'brief' => $faker->sentence(50),
                'created_at' => now(),
                'updated_at' => now()]);
        }

    }
}
