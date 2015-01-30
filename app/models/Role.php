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

	/**
	 * Returns whether this role is the administrator role.
	 *
	 * @return boolean
	 */
	public function isAdmin() {
		return $this->name == "Administrator";
	}

	/**
	 * Returns whether this role is the participant role.
	 *
	 * @return boolean
	 */
	public function isParticipant() {
		return $this->name == "Participant";
	}

}
