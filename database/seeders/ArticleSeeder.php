<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for($i=0; $i < 4; $i++) {
            $title = $faker->sentence(rand(2,6));
            DB::table('articles')->insert([
                'category_id'=> rand(1,7),
                'title' => $title,
                'content'=> $faker->paragraph(6),
                'image'=> $faker->imageUrl(1920, 700, 'cars', true, 'Faker'),
                'hit'=> 0,
                'slug' => str_slug($title),
                'created_at' => $faker->dateTime($max = 'now', $timezone = null),
                'updated_at' => $faker->dateTime($max = 'now', $timezone = null)
            ]);
        }
    }
}
