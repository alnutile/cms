<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PagesTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        foreach(range(1, 10) as $index)
        {
            Page::create(
                [
                     'title' => "Example 1",
                     'body'  => "Some text here",
                     'published' => 1
                ],
                [
                    'title' => "Example 2",
                    'body'  => "Some text here",
                    'published' => 1
                ]
            );
        }
    }

}