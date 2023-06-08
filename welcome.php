<?php
	session_start();
	include("connection.php");

	$user_id = $_SESSION['user_id'] ?? null;
	$name = $_SESSION['name'] ?? null;
	if(is_null($user_id) || is_null($name))
	{
		header('Location: login.php');
		exit();
	}

	$count = query("select count(*) as count from administrator where user_id='$user_id'");
	$count = fetch_all($count)[0]['count'];
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" href="welcome.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Goldman">
	</head>
	<body>
		<form action="logout.php" method="post">
			<input class="nav" type="submit" value="Logout" style="float: right; position: static;">
		</form>
		<br><br>
		<h1>Welcome: <?= $name ?></h1>
		<div align="center">
			<form action="search_document.php">
				<input type="submit" value="Search Document">
			</form>
			<br>
			<form action="search_site.php">
				<input type="submit" value="Search Site">
			</form>
			<?php
			if($count != 0)
			{
			?>
				<br>
				<form action="create_document.php">
					<input type="submit" value="Create Document">
				</form>
				<br>
				<form action="promote.php">
					<input type="submit" value="Promote">
				</form>
			<?php
			}
			?>
		</div>
	</body>
</html>