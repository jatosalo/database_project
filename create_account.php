<?php
	include("connection.php");

	$account = $_POST['account'] ?? null;
	$name = $_POST['name'] ?? null;
	$password = $_POST['password'] ?? null;
	$password_check = $_POST['password_check'] ?? null;

	$message = '';
	if(!is_null($account))
	{
		if($password != $password_check)
		{
			$message = 'Please Check Password Again!';
		}
		else
		{
			try
			{
				query("insert into user (account, name, password) values ('$account', '$name', '$password')");
				$user_id = query("select user_id from user where account = '$account'");
				$user_id = fetch_all($user_id)[0]['user_id'];
				query("insert into common_user values ('$user_id')");
				header("Location: login.php");
				exit();
			}
			catch(Exception $e)
			{
				$message = 'Account Already Exists!';
				$account = '';
			}
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" href="create_account_style.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Goldman">
	</head>
	<body>
		<div id="form">
			<h1>Create Account</h1>
			<span><?= $message ?></span>
			<form action="create_account.php" method = "post">
				<table>
					<tr>
						<td><label>Account:</label></td>
						<td><input type="text" name="account" required value="<?= $account ?>"></td>
					</tr>
					<tr>
						<td><label>Name:</label></td>
						<td><input type="text" name="name" required value="<?= $name ?>"></td>
					</tr>
					<tr>
						<td><label>Password:</label></td>
						<td><input type="password" name="password" required></td>
					</tr>
					<tr>
						<td><label>Typeagain:</label></td>
						<td><input type="password" name="password_check" required></td>
					</tr>
					<tr>
						<td colspan="2" align="center"><input type="submit" value="Create"></td>
					</tr>
				</table>
			</form>
		</div>
	</body>
</html>