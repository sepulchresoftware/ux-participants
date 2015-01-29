<?php

class Study extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'studies';

	/**
	 * The attributes that can be auto-filled.
	 *
	 * @var array
	 */
	protected $fillable = array('name', 'active', 'author_id');

	/**
	 * Retrieve the author who created the study.
	 *
	 * @return User
	 */
	public function author() {
		return $this->hasOne('users', 'user_id', 'author_id');
	}

}
