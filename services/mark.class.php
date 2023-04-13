<?php 

class Mark {
	private $db;
	private $msg;


	function __construct($db) {
		$this->db = $db;
	}

	public function setMark($user_id, $value) {
		$sqll = "SELECT * FROM attendance WHERE user_id = ? AND att_date = CURRENT_DATE";
		$stmtt = $this->db->run($sqll, [$user_id]);
		if ($stmtt->rowCount() > 0) {
			$this->message(302, "User already marked for today");
		} else {
			$sql = "INSERT INTO attendance(user_id, is_present, att_date) VALUES (?,?,?)";
			$stmt = $this->db->run($sql, [$user_id, $value, date("Y:m:d")]);
			if ($stmt->rowCount() > 0) {
				$this->message(200, "Successfully Marked");
			} else {
				$this->message(301, "Something Went Wrong");
			}
		}

		return json_encode($this->msg);
	}

	public function getAbsentees() {
		$sql = "SELECT u.user_id, u.salary AS salary, CONCAT(u.first_name, ' ', u.last_name) AS full_name
				FROM users as u
				JOIN attendance as a
				ON u.user_id = a.user_id
				WHERE a.is_present = ? GROUP BY a.user_id";
		$stmt = $this->db->run($sql, [0]);
		if ($stmt->rowCount() > 0) {
			$this->message(200, $stmt->fetchAll());
		}  else {
			$this->message(301, "No Users Available");
		}

		return $this->msg;
	}

	private function message($key, $value) {
		$this->msg["status"] = $key;
		$this->msg["message"] = $value;
	}


}