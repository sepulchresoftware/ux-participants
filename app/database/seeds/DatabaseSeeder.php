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

		// run the seeder
		$this->call('RoleTableSeeder');
		$this->call('UserTableSeeder');
	}

}
