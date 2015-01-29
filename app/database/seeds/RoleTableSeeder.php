<?php

class RoleTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// default roles
		Role::create(array(
			'name' => 'Administrator'
		));
		Role::create(array(
			'name' => 'Participant'
		));
	}

}