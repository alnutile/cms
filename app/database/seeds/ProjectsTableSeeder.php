<?php

class ProjectsTableSeeder extends Seeder {

	public function run()
	{
        DB::table('projects')->truncate();
        $dateTime = new DateTime('now');
        $dateTime = $dateTime->format('Y-m-d H:i:s');

        Project::create(
            [
                'title' => "Project 1",
                'body'  => '<p>At vero eos et accusam et justo duo dolores et ea rebum. Consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat.</p>',
                'published' => 1,
                'order' => 1,
                'image' => 'project1.gif',
                'portfolio_id' => 1,
                'seo' => "SEO TITLE FOR PROJECT 1",
                'slug' => '/project_one',
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ]
        );

        Project::create(
            [
                'title' => "Project 2",
                'body'  => '<p>At vero eos et accusam et justo duo dolores et ea rebum. Consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat.</p>',
                'published' => 1,
                'order' => 1,
                'image' => 'project2.gif',
                'portfolio_id' => 1,
                'seo' => "SEO TITLE FOR PROJECT 2",
                'slug' => '/project_another',
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ]
        );

        Project::create(
            [
                'title' => "Project 3",
                'body'  => '<p>At vero eos et accusam et justo duo dolores et ea rebum. Consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat.</p>',
                'published' => 1,
                'order' => 1,
                'image' => 'project3.jpg',
                'portfolio_id' => 2,
                'seo' => "SEO TITLE FOR PROJECT 3",
                'slug' => '/project_three',
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ]
        );

        Project::create(
            [
                'title' => "Project 4",
                'body'  => '<p>At vero eos et accusam et justo duo dolores et ea rebum. Consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat.</p>',
                'published' => 1,
                'order' => 1,
                'image' => 'project4.jpg',
                'portfolio_id' => 2,
                'seo' => "SEO TITLE FOR PROJECT 4",
                'slug' => '/build_big_something',
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ]
        );

	}

}