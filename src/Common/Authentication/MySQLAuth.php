<?php

namespace Common\Authentication;

class dbAuth implements CommonAuth
{
	public function authenticate($username = '', $password = '')
	{
		if ($this->username == '') {
			$this->username = $username;
		}
		if ($this->password == '') {
			$this->password = $password;
		}

		$conn = db_connect();
		$sql = "SELECT username, password FROM user;";
		//$result = $conn->query($sql);
		$query = $conn->query($sql);
		$result = $query->execute();
		$rows = $query->fetchAll(PDO::FETCH_ASSOC);

		foreach ($rows[0] as $key => $value) {
			if (($key === 'username' && $value !== $this->username)||($key === 'password' && $value !== $this->password)) {
				$this->status = NON_ACTIVE;
				return FALSE;
			}
		}

		// if ($result->num_rows > 0) {
		//     while($row = $result->fetch_assoc()) {
		// 		if($row["username"] === $this->username && $row["password"] === $this->password)
		// 		{
		// 			$this->status = ACTIVE;
		// 			$this->lastLogin = time();
		// 			return TRUE;
		// 		}
		//     }
		// }
		// $this->status = NON_ACTIVE;
		// return FALSE;


		$this->status = ACTIVE;
		$this->lastLogin = time();
		return TRUE;
	}
}
?>