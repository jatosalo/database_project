<?php
	session_start();
	$message = $_SESSION['message'] ?? '';
	unset($_SESSION['message']);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" href="login.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Goldman">
	</head>
	<body>
		<div id="form">
			<h1>Confirm Identity</h1>
			<form id="login_check" action="login_check.php" method="post"></form>
			<form id="create_account" action="create_account.php" method="post"></form>
			<span><?= $message ?></span>
			<table>
				<tr>
					<td><label>Account:</label></td>
					<td><input type="text" name="account" form="login_check" required></td>
				</tr>
				<tr>
					<td><label>Password:</label></td>
					<td><input type="password" name="password" form="login_check" required></td>
				</tr>
				<tr>
					<td colspan="2" align="center"><input type="submit" value="Login" form="login_check"></td>
				</tr>
				<tr>
					<td colspan="2" align="center"><input type="submit" value="Create Account" form="create_account"></td>
				</tr>
			</table>
		</div>
	</body>
</html>