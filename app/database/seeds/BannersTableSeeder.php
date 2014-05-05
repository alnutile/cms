<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class BannersTableSeeder extends Seeder {

	public function run()
	{
        $dateTime = new DateTime('now');
        $dateTime = $dateTime->format('Y-m-d H:i:s');

        $banners = array(
            array(
                'name'          => 'Banner 1',
                'banner_name'   => 'banner1.jpg',
                'order'         => 1,
                'active'        => 1,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ),
            array(
                'name'          => 'Banner 2',
                'banner_name'   => 'banner2.jpg',
                'order'         => 1,
                'active'        => 1,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ),
            array(
                'name'          => 'Banner 3',
                'banner_name'   => 'banner3b.jpg',
                'order'         => 1,
                'active'        => 1,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ),
        );
        DB::table('banners')->insert( $banners );
	}

}