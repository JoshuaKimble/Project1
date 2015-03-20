<?php

namespace Common\Authentication;

use PDO;

class MySQLAuth implements IAuthentication
{
	protected function db_connect()
	{
	    $connectionArray = file('../src/Common/Authentication/the_castle_of_aaarrrrggh');
	    $server   = chop($connectionArray[0]);
	    $username = chop($connectionArray[1]);
	    $password = chop($connectionArray[2]);
	    $database = chop($connectionArray[3]);

	    try {
	        $conn = new PDO('mysql:host='.$server.';dbname='.$database.';', $username, $password);
	        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	        return $conn;
	    }
	    catch(PDOException $e) {
	        return "Connection failed: " . $e->getMessage();
	    }
	}

	public function authenticate($username = '', $password = '')
	{
		if ($this->username == '') {
			$this->username = $username;
		}
		if ($this->password == '') {
			$this->password = $password;
		}

		$conn = $this->db_connect();
		$sql = "SELECT username, password FROM user WHERE username='$username' AND password='$password';";
		$query = $conn->query($sql);
		$rows = $query->fetch(PDO::FETCH_NUM);

		if ($rows > 0) {
			$this->status = ACTIVE;
			$this->lastLogin = time();
			return TRUE;
		}
		$this->status = NON_ACTIVE;
		return FALSE;
	}
}
?>