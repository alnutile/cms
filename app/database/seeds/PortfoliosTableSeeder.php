<?php

class PortfoliosTableSeeder extends Seeder {

	public function run()
	{
        DB::table('portfolios')->truncate();

        Portfolio::create(
            [
                'title' => "Item 1",
                'body'  => 'This is your portfolio page 1',
                'published' => 1,
                'order' => 1,
                'slug' => '/portfolio1'
            ]
        );

        Portfolio::create(
            [
                'title' => "Item 2",
                'body'  => 'This is your portfolio page 2',
                'published' => 1,
                'order' => 1,
                'slug' => '/portfolio1'
            ]
        );
	}

}