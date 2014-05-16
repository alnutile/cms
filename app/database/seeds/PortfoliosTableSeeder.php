<?php

class PortfoliosTableSeeder extends Seeder {

	public function run()
	{
        DB::table('portfolios')->truncate();

        Portfolio::create(
            [
                'title' => "Portfolio 1",
                'body'  => 'This is your portfolio page 1',
                'published' => 1,
                'order' => 1,
                'seo'  => 'Portfolio 1 SEO',
                'slug' => '/portfolio1'
            ]
        );

        Portfolio::create(
            [
                'title' => "Portfolio 2",
                'body'  => 'This is your portfolio page 2',
                'published' => 1,
                'order' => 1,
                'seo'  => 'Portfolio 2 SEO',
                'slug' => '/portfolio2'
            ]
        );
	}

}