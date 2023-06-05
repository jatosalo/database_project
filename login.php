<?php
		include("connection.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Goldman">
</head>
<body>
	<div id = "form">
		<div id = "form_topic"><h1>Confirm Identity</h1></div>
		<form name = "form" action = "login_check.php" method = "POST">
			<label> Username: </label>
			<input type = "text" id = "user" name = "user"><br><br>
			<label> Password: </label>
			<input type = "password" id = "pass" name = "pass"><br><br>
			<div align = "center">
			<input type = "submit" id = "btn_login" value = "Login" name = "submit" style="width:200px;height:40px; font-family: 'Goldman';">
			</div>
		</form>
	</div>
</body>
</html>