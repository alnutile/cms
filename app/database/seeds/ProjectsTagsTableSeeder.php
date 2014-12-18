<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ProjectsTagsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

        $projectIds = Project::lists('id');
        $tagsIds = Tag::lists('id');

		foreach(range(1, 10) as $index)
		{
			DB::table('project_tag')->insert([

                'project_id' => $faker->randomElement($projectIds),
                'tag_id' => $faker->randomElement($tagsIds)
            ]);
		}
	}

}