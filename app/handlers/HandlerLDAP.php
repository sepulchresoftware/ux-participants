<?php namespace METALab\LDAP;

use Toyota\Component\Ldap\Core\Manager,
    Toyota\Component\Ldap\Platform\Native\Driver,
    Toyota\Component\Ldap\Exception\BindException;

/**
 * Handler class for LDAP operations using the Tiesa LDAP package.
 */
class HandlerLDAP
{
	private $ldap;

	// LDAP configuration
	private $host;
	private $basedn;
	private $dn;
	private $password;

	// true to allow auth binds without a password
	private $allowNoPass;

	/**
	 * Constructs a new HandlerLDAP object.
	 *
	 * @param string $host The LDAP hostname
	 * @param string $basedn The LDAP base DN
	 * @param string $dn The full LDAP DN for binding
	 * @param string $password The password for binding
	 */
	public function __construct($host, $basedn, $dn, $password) {
		$this->host = $host;
		$this->basedn = $basedn;
		$this->dn = $dn;
		$this->password = $password;

		// false by default so we don't accidentally cause security problems
		$this->allowNoPass = false;
	}

	/**
	 * Attempts to bind to the LDAP server with the provided username and
	 * password. Throws a BindException if the bind operation fails.
	 *
	 * @param string $username The username with which to bind
	 * @param string $password The password with which to bind
	 * @throws BindException If the binding operation fails
	 */
	public function bind($username, $password) {
		$this->ldap->bind($username, $password);
	}

	/**
	 * Returns whether blank passwords are allowed for binding.
	 *
	 * @return boolean
	 */
	public function canAllowNoPass() {
		return $this->allowNoPass;
	}

	/**
	 * Connects and binds to the LDAP server. An optional username and password
	 * can be supplied to override the default credentials. Returns whether the
	 * connection and binding was successful.
	 *
	 * @param string $username The override username to use
	 * @param string $password The override password to use
	 *
	 * @throws Exception If the LDAP connection fails
	 * @return boolean
	 */
	public function connect($username="", $password="") {
		$params = array(
		    'hostname'  => $this->host,
		    'base_dn'   => $this->basedn,
		);
		$this->ldap = new Manager($params, new Driver());

		// connect to the server and bind with the credentials
		try
		{
			$this->ldap->connect();

			// if override parameters have been specified then use those
			// for the binding operation
			if(!empty($username)) {

				$selectedUsername = "uid=" . $username . "," . $this->basedn;
				$selectedPassword = "";

				// do we allow empty passwords for bind attempts?
				if(empty($password)) {
					if($this->allowNoPass) {
						// yes so use the constructor-provided DN and password
						$selectedUsername = $this->dn;
						$selectedPassword = $this->password;
					}
				}
				else
				{
					// password provided so use what we were given
					$selectedPassword = $password;
				}

				// now perform the bind
				$this->bind($selectedUsername, $selectedPassword);
			}
			else
			{
				$this->bind($this->dn, $this->password);
			}

			// if it hits this return then the connection was successful and
			// the binding was also successful
			return true;
		}
		catch(BindException $be)
		{
			// could not bind with the provided credentials
			return false;
		}
		catch(Exception $e)
		{
			throw $e;
		}

		// something else went wrong
		return false;
	}

	/**
	 * Returns the value of the specified attribute from the result set. Returns
	 * false if the attribute could not be found.
	 *
	 * @param Result-instance $results The result-set to search through
	 * @param string $attr_name The attribute name to look for
	 * @return string|integer|boolean
	 */
    public function getAttributeFromResults($results, $attr_name) {
        $attr = false;
        foreach($results as $node)
            {
            	//dd($node->getAttributes());
                foreach($node->getAttributes() as $attribute)
                {   
                    if ($attribute->getName() == $attr_name)
                    {
                        $attr =  $attribute->getValues()[0]; // attribute found
                        break;
                    }
                }
            }
        return $attr;
    }

    /**
     * Returns whether the result set passed has at least one valid record in it.
     *
     * @param Result-instant $results The set of results to check
     * @return boolean
     */
    public function isValidResult($results) {
    	return $results->valid();
    }

	/**
	 * Queries LDAP for the record with the specified email.
	 *
	 * @param string $email The email to use for searching
	 * @return Result-instance
	 */
	public function searchByEmail($email) {
		$results = $this->ldap->search($this->basedn, 'mail=' . $email);
		return $results;
	}

	/**
	 * Queries LDAP for the record with the specified uid.
	 *
	 * @param string $uid The uid to use for searching
	 * @return Result-instance
	 */
	public function searchByUid($uid) {
		$results = $this->ldap->search($this->basedn, 'uid=' . $uid);
		return $results;
	}

	/**
	 * Sets whether blank passwords are allowed for binding attempts.
	 *
	 * @param boolean $allowNoPass Whether to allow blank passwords
	 */
	public function setAllowNoPass($allowNoPass) {
		$this->allowNoPass = $allowNoPass;
	}
}