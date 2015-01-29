<?php

class Role extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'roles';

	/**
	 * The attributes that can be auto-filled.
	 *
	 * @var array
	 */
	protected $fillable = array('name');

}
