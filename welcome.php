<?php
	$user_account = "jatosalo";
	//$user_account = $_COOKIE['u_acc'];
	//get user account
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" href="welcome.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Goldman">
</head>
<body>
	<br><br>
	<?php
		echo "<h1 id = 'welcome_title'>Welcome: $user_account</h1>";
	?>
	<div id = "btns">
	<form action="search_document.php">
    	<input class = "btn" type="submit" value="Document" style="width:200px;height:40px; font-family: 'Goldman';">
	</form>
	<br>
	<form action="search_site.php">
    	<input class = "btn" type="submit" value="Site" style="width:200px;height:40px; font-family: 'Goldman';">
	</form>
	</div>
</body>
</html>