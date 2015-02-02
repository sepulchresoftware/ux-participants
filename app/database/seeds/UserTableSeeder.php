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
			'password' => sha1('admin'),
		));

		// default participant user
		User::create(array(
			'uid' => 'participant',
			'name' => 'Partic I. Pant',
			'email' => 'participant@example.com',
			'role_id' => 2,
			'password' => sha1('participant'),
		));
	}

}