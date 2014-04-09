<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PagesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('pages')->truncate();

        Page::create(
            [
                'title' => "Home Page",
                'body'  => 'This will be your home page',
                'published' => 1,
                'slug' => '/home'
            ]
        );

        Page::create(
            [
                'title' => "About Page",
                'body'  => 'This will be your about page',
                'published' => 1,
                'slug' => '/about'
            ]
        );

        Page::create(
            [
                'title' => "Contact Page",
                'body'  => 'This will be your Contact page',
                'published' => 1,
                'slug' => '/contact'
            ]
        );

    }
}