<?php
	//include("connection.php");

	$user_account = "jatosalo";
	//session_start();
	//$user_account = $_SESSION["u_acc"];
	//get user account

	$document_id = $_POST['document_id'] ?? null;
	$title = $_POST['title'] ?? null;
	$safe_level = $_POST['safe_level'] ?? null;
	$content = $_POST['content'] ?? null;
	$post_ans_empty = false;
	if($document_id == null or $title == null or $content == null) $post_ans_empty = true;
	/*
	TODO:sql check
	$id_used = check if document_id is used

	
	
	if($id_used or post_ans_empty){
		echo '<script>
			window.location.href = "create.php";
			alert("Create Failed!");
			</script>';
	}
	else{
		TODO:sql create new document (values as below)

		$document_id
		$title
		$content
		$safe_level
		date("Y-m-d")
		$user_account
		[site of this user]

		echo '<script>
			window.location.href = "create.php";
			alert("Create Success!");
			</script>';
	}
	*/


	print_r($_POST);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<link rel="stylesheet" href="create_style.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Goldman">
	</head>
	<body>
		<div>
			<div>
				<h1>Document Creating</h1>
			</div>
			<form id="form" method="post" action="create_document.php">
				<label> ID: </label>
				<input type="text" name="document_id" value="<?= $document_id ?>">
				<br><br>
				<label> Name: </label>
				<input type="text" name="title" value="<?= $title ?>">
				<br><br>
				<label> Safe Level: </label>
				<select name = "safe_level">
					<option value="1">Safe</option>
		        	<option value="2">Euclid</option>
		        	<option value="3">Keter</option>
				</select>
				<br><br>
				<label> Content: </label>
				<input type="text" name="content" value="<?= $content ?>">
				<br><br>
				<div align="center">
					<input type="submit" id="btn_create" value="Create">
				</div>
			</form>
		</div>
		<br><br><br>
	</body>
	<script>
		function resort(sort)
		{
			element = document.createElement("button");
			element.setAttribute("type", "submit");
			element.setAttribute("name", "sort");
			element.setAttribute("value", sort);
			element.style.display = "none";
			document.getElementById("form").appendChild(element);
			element.click();
		}
	</script>
</html>