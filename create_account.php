<?php
	//include("connection.php");
	if(isset($_POST['submit'])){
		if($_POST['pass'] != $_POST['pass_check']){
			echo '<script>
				window.location.href = "create_account.php";
				alert("Please Check Password Again!");
				</script>';
		}
		else{
			/*
				TODO : add common user, parameter as below.
				$_POST['user']
				$_POST['pass']
			*/
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
	<div id = "form">
		<div id = "form_topic"><h1>Confirm Identity</h1></div>
		<form name = "form" action = "create_account.php" method = "POST">
			<label> Username: </label>
			<input type = "text" id = "user" name = "user"><br><br>
			<label> Password: </label>
			<input type = "password" id = "pass" name = "pass"><br><br>
			<label> Typeagain: </label>
			<input type = "password" id = "pass_check" name = "pass_check"><br><br>
			<div align = "center">
			<input type = "submit" id = "btn_login" value = "Create" name = "submit" style="width:200px;height:40px; font-family: 'Goldman';">
			</div>
		</form>
	</div>
</body>
</html>