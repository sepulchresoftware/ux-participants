<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	/**
	 * The attributes that can be auto-filled.
	 *
	 * @var array
	 */
	protected $fillable = array('uid', 'name', 'email', 'password', 'role_id');

	/**
	 * Returns the role associated with this user.
	 *
	 * @return Role
	 */
	public function role() {
		return $this->hasOne('roles');
	}

	/**
	 * Returns all studied authored by this user.
	 *
	 * @return Collection:Study
	 */
	public function authoredStudies() {
		return $this->hasMany('studies', 'author_id');
	}

	/**
	 * Returns all studies associated with this user.
	 *
	 * @return Collection:Study
	 */
	public function studies() {
		return $this->belongsToMany('Study');
	}

	/**
	 * Returns whether this user is an administrator in the system.
	 *
	 * @return boolean
	 */
	public function isAdmin() {
		return $this->role->name == "Administrator";
	}

	/**
	 * Returns whether this user is a potential participant in the system.
	 *
	 * @return boolean
	 */
	public function isParticipant() {
		return $this->role->name == "Participant";
	}
}
