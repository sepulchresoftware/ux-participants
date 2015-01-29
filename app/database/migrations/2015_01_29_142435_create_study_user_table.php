<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudyUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// build the table
		Schema::create('study_user', function($table)
		{
		    $table->increments('id');
		    $table->integer('study_id');
		    $table->integer('user_id');
		    $table->string('timestamp', 30);
		    $table->boolean('confirmed');
		    $table->string('confirmed_on', 30);
		    $table->integer('confirmed_by');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// drop the table
		Schema::drop('study_user');
	}

}
