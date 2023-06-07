<?php
	session_start();
	include("connection.php");

	$account = $_POST['account'] ?? null;
	$password = $_POST['password'] ?? null;

	$location = 'login.php';
	if(!is_null($account) && !is_null($password))
	{
		$user_id = query("select user_id from user where account='$account' and password='$password'");
		$user_id = fetch_all($user_id)[0]['user_id'] ?? null;
		if(is_null($user_id))
		{
			$_SESSION['message'] = 'Incorrect Account or Password!';
		}
		else
		{
			$_SESSION['user_id'] = $user_id;
			$location = 'welcome.php';
		}
	}
	header("Location: $location");
	exit();
?>