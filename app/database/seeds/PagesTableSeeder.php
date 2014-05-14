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
                'slug' => '/home',
                'menu_sort_order' => 0,
                'menu_parent' => 0,
                'menu_name' => 'top',
                'redirect_url' => ''
            ]
        );

        Page::create(
            [
                'title' => "About Page",
                'body'  => 'This will be your about page',
                'published' => 1,
                'slug' => '/about',
                'menu_sort_order' => 1,
                'menu_parent' => 1,
                'menu_name' => 'top',
                'redirect_url' => ''
            ]
        );

        Page::create(
            [
                'title' => "Contact Page",
                'body'  => 'This will be your Contact page',
                'published' => 1,
                'slug' => '/contact',
                'menu_sort_order' => 3,
                'menu_parent' => 0,
                'menu_name' => 'top',
                'redirect_url' => ''
            ]
        );

        Page::create(
            [
                'title' => "Portfolio",
                'body'  => 'Your related Portfolio pages and their projects',
                'published' => 1,
                'slug' => '/portfolio',
                'menu_sort_order' => 2,
                'menu_parent' => 0,
                'menu_name' => 'top',
                'redirect_url' => ''
            ]
        );
    }
}