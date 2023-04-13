<?php 

class User {
	private $db;
	private $msg;

	function __construct($db) {
		$this->db = $db;
	}

	public function login($username, $password) {
		if (empty($username) || empty($password)) {
			$this->message(300, "All fields are required");
		} else {
			$sql = "SELECT * FROM users WHERE username = ?";
			$stmt = $this->db->run($sql, [$username]);
			if ($stmt->rowCount() > 0) {
				$result = $stmt->fetch();
				$decript = password_verify($password, $result['password']);
				if ($decript != false) {
					$_SESSION['admin'] = $result["user_id"];
					$this->message(200, "Login Successful");
				} else {
					$this->message(300, "Incorrect Password");
				}
			} else {
				$this->message(300, "No User found");
			}
		}
		return json_encode($this->msg);
	}


	public function getUsers() {
		$sql = "SELECT * FROM users WHERE is_admin != ?";
		$stmt = $this->db->run($sql, [1]);
		if ($stmt->rowCount() > 0) {
			$this->message(200, $stmt->fetchAll());
		} else {
			$this->message(301, "No Users Available");
		}

		return $this->msg;
	}

	private function message($key, $value) {
		$this->msg["status"] = $key;
		$this->msg["message"] = $value;
	}

}