<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// build the table
		Schema::create('studies', function($table)
		{
		    $table->increments('id');
		    $table->text('name');
		    $table->text('description');
		    $table->boolean('active')->default(1);
		    $table->integer('author_id');
		    $table->timestamps();
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
		Schema::drop('studies');
	}

}
