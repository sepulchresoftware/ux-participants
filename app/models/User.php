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
	 * The primary key used by the model.
	 *
	 * @var string
	 */
	protected $primaryKey = 'id';

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
	protected $fillable = array('uid', 'name', 'email', 'role_id');

	/**
	 * Returns the role associated with this user.
	 *
	 * @return Role
	 */
	public function role() {
		return $this->belongsTo('Role');
	}

	/**
	 * Returns all studies authored by this user.
	 *
	 * @return Collection:Study
	 */
	public function authoredStudies() {
		return $this->hasMany('Study', 'author_id');
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
		return $this->role->isAdmin();
	}

	/**
	 * Returns whether this user is a potential participant in the system.
	 *
	 * @return boolean
	 */
	public function isParticipant() {
		return $this->role->isParticipant();
	}
}
