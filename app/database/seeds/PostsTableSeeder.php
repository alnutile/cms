<?php

use Faker\Factory as Faker;
class PostsTableSeeder extends Seeder {

	public function run()
	{
        DB::table('posts')->truncate();
        $dateTime = new DateTime('now');
        $dateTime = $dateTime->format('Y-m-d H:i:s');

        $faker = Faker::create();

        foreach(range(1, 10) as $index)
        {
        Post::create(
            [
                'title' => "POST 4",
                'body'  => $faker->paragraph(4),
                'intro' => $faker->paragraph(4),
                'published' => 1,
                'image' => 'project4.jpg',
                'slug' =>  '/' . $faker->word,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ]
        );
        }

	}

}
