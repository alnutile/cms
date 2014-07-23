<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
        DB::table('users')->truncate();


        $dateTime = new DateTime('now');
        $dateTime = $dateTime->format('Y-m-d H:i:s');

        $users = array(
            array(
                'firstname'  => 'Alfred',
                'lastname'  => 'Nutile',
                'admin'     => 1,
                'active'     => 1,
                'email'      => 'admin@example.com',
                'password'   => Hash::make('admin'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            )
        );
        DB::table('users')->insert( $users );

        $users = array(
            array(
                'firstname'  => 'Test',
                'lastname'  => 'Two',
                'admin'     => 1,
                'active'     => 1,
                'email'      => 'test@gmail.com',
                'password'   => Hash::make('admin'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ),
            array(
                'firstname'  => 'Test',
                'lastname'  => 'Three',
                'admin'     => 0,
                'active'     => 1,
                'email'      => 'test3@gmail.com',
                'password'   => Hash::make('password'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            )
        );
        DB::table('users')->insert( $users );
	}

}
