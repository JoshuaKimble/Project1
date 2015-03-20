<?php

namespace Common\Authentication;

class FileAuth implements IAuthentication
{
	public function authenticate($username = '', $password = '')
	{
		if ($this->username == '') {
			$this->username = $username;
		}
		if ($this->password == '') {
			$this->password = $password;
		}

		$credentials = file('../src/Common/Authentication/very_small_rocks');
		$name = chop($credentials[0]);
		$pass = chop($credentials[1]);

		if($name !== $this->username || $pass !== $this->password)
		{
			$this->status = NON_ACTIVE;
			return FALSE;
		}

		$this->status = ACTIVE;

		$this->lastLogin = time();
		
		return TRUE;
	}
	public function getStatus($username) {
		return $this->status;
	}
	public function getLastLogin($username) {
		return $this->lastLogin;
	}
}
?>