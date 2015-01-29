<?php

class UserTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// default admin user
		User::create(array(
			'uid' => 'admin',
			'name' => 'Admin I. Strator',
			'email' => 'admin@example.com',
			'role_id' => 1,
			'password' => sha1('password'),
		));
	}

}