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
	$count = query("select count(*) as count from administrator where user_id = '$user_id'");
	$count = fetch_all($count)[0]['count'];
	if($count == 0)
	{
		header('Location: welcome.php');
		exit();
	}

	$site_id = $_POST['site_id'] ?? null;
	$name = $_POST['name'] ?? null;
	$location = $_POST['location'] ?? null;

	$success_message = '';
	$failed_message = '';
	if(!is_null($name) && !is_null($location))
	{
		$start_date = date('Y-m-d');
		try
		{
			query("insert into site values ('$site_id', '$name', '$location', '$start_date', '$user_id')");
			$success_message = 'Create Success!';
			$site_id = '';
			$name = '';
			$location = '';
		}
		catch(Exception $e)
		{
			$failed_message = 'Create Failed!';
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<link rel="stylesheet" href="create_style.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Goldman">
	</head>
	<body>
		<?php include('nav.php'); ?>
		<div>
			<h1>Site Creating</h1>
			<span style="color: green"><?= $success_message ?></span>
			<span style="color: red"><?= $failed_message ?></span>
			<form id="form" method="post" action="create_site.php">
				<label> ID: </label>
				<input type="text" name="site_id" value="<?= $site_id ?>">
				<br><br>
				<label> Name: </label>
				<input type="text" name="name" value="<?= $name ?>" required>
				<br><br>
				<label> Location: </label>
				<input type="text" name="location" value="<?= $location ?>" required>
				<br><br>
				<div align="center">
					<input type="submit" value="Create">
				</div>
			</form>
		</div>
		<br><br><br>
	</body>
</html>