<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
        $this->call('UsersTableSeeder');
        $this->call('BannersTableSeeder');
        $this->call('SettingsTableSeeder');
        $this->call('PagesTableSeeder');
        $this->call('PortfoliosTableSeeder');
        $this->call('ProjectsTableSeeder');
    }

}