<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PagesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('pages')->truncate();

        $faker = Faker::create();

        foreach(range(1, 10) as $index)
        {
            Page::create(
                [
                     'title' => $faker->word(2),
                     'body'  => $faker->paragraph(3),
                     'published' => 1
                ]
            );
        }
    }
}