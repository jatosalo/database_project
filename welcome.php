<?php
	$user_account = "jatosalo";
	//session_start();
	//$user_account = $_SESSION["u_acc"];
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
	<div align = "center">
	<form action="search_document.php">
    	<input class = "btn" type="submit" value="Search Document" style="width:200px;height:40px; font-family: 'Goldman';">
	</form>
	<br>
	<form action="search_site.php">
    	<input class = "btn" type="submit" value="Search Site" style="width:200px;height:40px; font-family: 'Goldman';">
	</form>

	<!--
		TODO:sql check
		if this user is adminsrator, do below.
	-->
	<br>
	<form action="create_document.php">
    	<input class = "btn" type="submit" value="Create Document" style="width:200px;height:40px; font-family: 'Goldman';">
	</form>
	<br>
	<form action="promote.php">
    	<input class = "btn" type="submit" value="Promote" style="width:200px;height:40px; font-family: 'Goldman';">
	</form>
	</div>
</body>
</html>