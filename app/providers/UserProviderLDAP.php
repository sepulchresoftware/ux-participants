<?php namespace METALab\Auth\Provider;

use Illuminate\Auth\UserInterface,
	Illuminate\Auth\UserProviderInterface,
	Illuminate\Support\Facades\Config,
    METALab\LDAP\HandlerLDAP;

use User;

/**
 * Service provider handler that provides LDAP authentication operations.
 */
class UserProviderLDAP implements UserProviderInterface
{
	private $ldap;

	/**
	 * Constructs a new UserProviderLDAP object.
	 */
	public function __construct() {
		$this->ldap = new HandlerLDAP(
			Config::get('app.ldap.host'),
			Config::get('app.ldap.basedn'),
			Config::get('app.ldap.dn'),
			Config::get('app.ldap.password'));

		// set whether blank passwords are allowed to be used for auth
		$this->ldap->setAllowNoPass(Config::get('app.ldap.allow_no_pass'));
	}

	/**
 	 * Retrieves the user with the specified credentials from LDAP. Returns null
     * if the user could not be found.
 	 *
 	 * @param array $credentials The credentials to use
 	 * @return User|null
 	 */
    public function retrieveByCredentials(array $credentials) {
    	$u = $credentials['username'];
    	$p = $credentials['password'];

    	// attempt to auth with the credentials provided first
    	try
    	{
	    	if($this->testCredentials($u, $p)) {
	    		// the credentials are valid so let's do the full search with
	    		// the default DN provided through the constructor
	    		$this->ldap->connect();
	    		$result = $this->ldap->searchByUid($u);

	    		$uid = $this->ldap->getAttributeFromResults($result, "uid");

	    		// grab the first user with the specified attributes or create
	    		// a new Participant record in the DB
	    		return User::firstOrCreate(array(
	    			'uid' => $uid,
	    			'name' => $this->ldap->getAttributeFromResults($result, "displayName"),
	    			'email' => $this->ldap->getAttributeFromResults($result, "mail"),
	    			'role_id' => 2
	    		));
	    	}
    	}
    	catch(Exception $e)
    	{
    		// LDAP connection failure
    		return null;
    	}

    	// invalid login attempt
    	return null;
    }

	/**
	 * Retrieves the user with the specified identifier from the model.
	 *
	 * @param string $identifier The desired identifier to use
	 * @return User
	 */
    public function retrieveById($identifier) {
    	return User::where('id', '=', $identifier)->first();
    }

    /**
	 * Returns the user with the specified identifier and Remember Me token.
	 *
	 * @param string $identifier The identifier to use
	 * @param string $token The Remember Me token to use
	 * @return User
	 */
	public function retrieveByToken($identifier, $token) {
		return User::where('id', '=', $identifier)
			->where('remember_token', '=', $token)->first();
	}

	/**
	 * Returns whether the credentials provided can be used to authenticate
	 * against the directory.
	 *
	 * @param string $username The username to check
	 * @param string $password The password to check
	 * @return boolean
	 */
	protected function testCredentials($username, $password) {
		return $this->ldap->connect($username, $password);
	}

	/**
	 * Updates the Remember Me token for the specified identifier.
	 *
	 * @param UserInterface $user The user object whose token is being updated
	 * @param string $token The Remember Me token to update
	 */
    public function updateRememberToken(UserInterface $user, $token) {
	    if(!empty($user)) {
	    	$user->remember_token = $token;
	    	$user->save();
	    }
    }

    /**
 	 * Validates that the provided credentials match the provided user.
 	 *
 	 * @param UserInterface $user The provided user object
 	 * @param array $credentials The credentials against which to check
 	 * @return boolean
 	 */
    public function validateCredentials(UserInterface $user, array $credentials) {
    	// our external service, directory, etc. has already verified whether
    	// or not the credentials are valid so the point is moot here; instead,
    	// let's either "return true" to do a pass-through or do a check for
    	// whether the user is actually active and should be allowed to auth in.
		return !empty($user->email) && $user->active == TRUE;
    }
}