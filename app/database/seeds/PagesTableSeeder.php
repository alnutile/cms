<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PagesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('pages')->truncate();

        Page::create(
            [
                'title' => "Home",
                'body'  => 'This will be your home page',
                'published' => 1,
                'slug' => '/home',
                'seo'  => 'HOME PAGE SEO',
                'menu_sort_order' => 0,
                'menu_parent' => 0,
                'menu_name' => 'top',
                'redirect_url' => '',
				'hide_title' => 0
            ]
        );

        Page::create(
            [
                'title' => "Our Company",
                'body'  => 'This will be your about page',
                'published' => 1,
                'slug' => '/about',
                'seo'  => 'Our Company',
                'menu_sort_order' => 1,
                'menu_parent' => 1,
                'menu_name' => 'top',
                'redirect_url' => '',
				'hide_title' => 0
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
                'seo'  => 'CONTACT PAGE SEO',
                'menu_name' => 'top',
                'redirect_url' => '',
				'hide_title' => 0
            ]
        );

        Page::create(
            [
                'title' => "All Projects",
                'body'  => 'All Projects on the site edit Pages and Projects to add text here',
                'published' => 1,
                'slug' => '/all_projects',
                'menu_sort_order' => 2,
                'menu_parent' => 0,
                'seo'  => 'ALL PROJECTS SEO',
                'menu_name' => 'left_side',
                'redirect_url' => '',
				'hide_title' => 0
            ]
        );

        Page::create(
            [
                'title' => "Our Process",
                'body'  => 'Content goes here',
                'published' => 1,
                'slug' => '/our_Process',
                'menu_sort_order' => 2,
                'menu_parent' => 0,
                'seo'  => 'Our Process',
                'menu_name' => 'sub_nav',
                'redirect_url' => '',
				'hide_title' => 0
            ]
        );

        Page::create(
            [
                'title' => "Testimonials",
                'body'  => 'Content goes here',
                'published' => 1,
                'slug' => '/testimonials',
                'menu_sort_order' => 2,
                'menu_parent' => 0,
                'seo'  => 'Testimonials',
                'menu_name' => 'sub_nav',
                'redirect_url' => '',
				'hide_title' => 0
            ]
        );

        Page::create(
            [
                'title' => "News & Awards",
                'body'  => 'Content goes here',
                'published' => 1,
                'slug' => '/news_awards',
                'menu_sort_order' => 2,
                'menu_parent' => 0,
                'seo'  => 'News & Awards',
                'menu_name' => 'sub_nav',
                'redirect_url' => '',
				'hide_title' => 0
            ]
        );
    }
}