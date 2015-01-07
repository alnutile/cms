<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class TagsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
            $type = ['Project', 'Post'];
            $rand_type = array_rand($type, 1);
			Tag::create([

                'name' => $faker->unique()->word,
                'tagable_id' => $faker->randomDigit,
                'tagable_type' => $type[$rand_type],

			]);
		}
	}

}