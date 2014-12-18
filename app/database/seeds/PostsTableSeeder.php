<?php

class PostsTableSeeder extends Seeder {

	public function run()
	{
        DB::table('posts')->truncate();
        $dateTime = new DateTime('now');
        $dateTime = $dateTime->format('Y-m-d H:i:s');

        Post::create(
            [
                'title' => "POST 1",
                'body'  => '<p>At vero eos et accusam et justo duo dolores et ea rebum. Consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat.</p>',
                'published' => 1,
                'image' => 'project1.gif',
                'slug' => '/post_one',
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ]
        );

        Post::create(
            [
                'title' => "POST 2",
                'body'  => '<p>At vero eos et accusam et justo duo dolores et ea rebum. Consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat.</p>',
                'published' => 1,
                'image' => 'project2.gif',
                'slug' => '/post_another',
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ]
        );

        Post::create(
            [
                'title' => "POST 3",
                'body'  => '<p>At vero eos et accusam et justo duo dolores et ea rebum. Consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat.</p>',
                'published' => 1,
                'image' => 'project3.jpg',
                'slug' => '/post_three',
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ]
        );

        Post::create(
            [
                'title' => "POST 4",
                'body'  => '<p>At vero eos et accusam et justo duo dolores et ea rebum. Consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat.</p>',
                'published' => 1,
                'image' => 'project4.jpg',
                'slug' => '/post_build_big_something',
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ]
        );

	}

}