<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class SettingsTableSeeder extends Seeder {

	public function run()
	{
        $dateTime = new DateTime('now');
        $dateTime = $dateTime->format('Y-m-d H:i:s');

        $settings = array(
            array(
                'name'              => "My Company Name",
                'logo'              => 'logo-blue.png',
                'color'             => 'blue',
                'facebook'          => 'http://facebook.com/example_person',
                'linkedin'          => 'http://linkedin.com/example_person',
                'twitter'           => 'http://twitter.com/example_person',
                'pinterest'         => 'http://pinterest.com/example_person',
                'gplus'               => 'http://gplus/example_person',
                'footer'            => '<div class="text-center">444-555-1212 | test@test.com</div>',
                'maintenance_mode'  => 0,
                'theme'  => 0,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ),
        );
        DB::table('settings')->insert( $settings );
	}

}