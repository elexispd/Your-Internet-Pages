<?php 
 require_once "../services/initDB.php";
 include_once "../services/user.class.php";
 include_once "../services/mark.class.php";

 session_start();

$db = new InitDB();
$user_obj = new User($db);
$att_obj = new Mark($db);

$users = $user_obj->getUsers();

$absent = $att_obj->getAbsentees();

if (isset($_POST["mark"])) {
	switch ($_POST["mark"]) {
		case 'present':
			$mark = $att_obj->setMark($_POST['user_id'], 1);
			break;
		case 'absent':
			$mark = $att_obj->setMark($_POST['user_id'], 0);
	}

	print_r($mark);
}

if (isset($_POST["login"])) {
	$result = $user_obj->login(htmlspecialchars($_POST["username"]), $_POST['password']);
	print_r($result);
}

if (isset($_POST["logout"])) {
	session_unset();
	session_destroy();
	header("location: ../views/login.php");
}





