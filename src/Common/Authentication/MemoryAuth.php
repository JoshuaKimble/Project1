<?php

namespace Common\Authentication;

class MemoryAuth implements IAuthentication
{
	public function __construct($username = '', $password = '')
	{
		$this->username = $username;
		$this->password = $password;
	}
	
	public function authenticate($username = '', $password = '')
	{
		if ($this->username == '') {
			$this->username = $username;
		}
		if ($this->password == '') {
			$this->password = $password;
		}
		if ($this->username !== 'joshuakimble') {
			$this->status = NON_ACTIVE;
			return false;
		}
		if ($this->password !== 'pass') {
			$this->status = NON_ACTIVE;
			return false;
		}
		
		$this->status = ACTIVE;
		
		$this->lastLogin = time();
		
		return true;
	}
}
?>