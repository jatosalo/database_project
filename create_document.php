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

	$document_id = $_POST['document_id'] ?? null;
	$title = $_POST['title'] ?? null;
	$safe_level = $_POST['safe_level'] ?? null;
	$content = $_POST['content'] ?? null;

	$success_message = '';
	$failed_message = '';
	if(!is_null($title) && !is_null($safe_level) && !is_null($content))
	{
		$post_date = date('Y-m-d');
		$site_id = query("select site_id from administrator where user_id = '$user_id'");
		$site_id = fetch_all($site_id)[0]['site_id'];
		try
		{
			query("insert into document values ('$document_id', '$title', '$content', '$safe_level', '$post_date', '$user_id', '$site_id')");
			$success_message = 'Create Success!';
			$document_id = '';
			$title = '';
			$safe_level = '1';
			$content = '';
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
			<h1>Document Creating</h1>
			<span style="color: green"><?= $success_message ?></span>
			<span style="color: red"><?= $failed_message ?></span>
			<form id="form" method="post" action="create_document.php">
				<label> ID: </label>
				<input type="text" name="document_id" value="<?= $document_id ?>">
				<br><br>
				<label> Name: </label>
				<input type="text" name="title" value="<?= $title ?>" required>
				<br><br>
				<label> Safe Level: </label>
				<select name = "safe_level" required>
					<option value="1" <?= $safe_level == 1 ? 'selected' : '' ?>>Safe</option>
		        	<option value="2" <?= $safe_level == 2 ? 'selected' : '' ?>>Euclid</option>
		        	<option value="3" <?= $safe_level == 3 ? 'selected' : '' ?>>Keter</option>
				</select>
				<br><br>
				<label> Content: </label>
				<input type="text" name="content" value="<?= $content ?>" required>
				<br><br>
				<div align="center">
					<input type="submit" value="Create">
				</div>
			</form>
		</div>
		<br><br><br>
	</body>
</html>