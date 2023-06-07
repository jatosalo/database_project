<?php
	session_start();
	include("connection.php");

	$account = $_POST['account'] ?? null;
	$password = $_POST['password'] ?? null;

	$location = 'login.php';
	if(!is_null($account) && !is_null($password))
	{
		$user_info = query("select user_id, name from user where account='$account' and password='$password'");
		$user_info = fetch_all($user_info);
		if(count($user_info) == 0)
		{
			$_SESSION['message'] = 'Incorrect Account or Password!';
		}
		else
		{
			$user_id = $user_info[0]['user_id'];
			$name = $user_info[0]['name'];
			$_SESSION['user_id'] = $user_id;
			$_SESSION['name'] = $name;
			$location = 'welcome.php';
		}
	}
	header("Location: $location");
	exit();
?>