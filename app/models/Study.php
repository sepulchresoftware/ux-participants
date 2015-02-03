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
	protected $fillable = array('name', 'description', 'active', 'author_id');

	/**
	 * Retrieve the author who created the study.
	 *
	 * @return User
	 */
	public function author() {
		return $this->belongsTo('users', 'author_id');
	}

	/**
	 * Returns the set of all potential participants in the study.
	 *
	 * @return Collection:User
	 */
	public function participants() {
		return $this->belongsToMany('User');
	}

}
