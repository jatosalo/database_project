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

	$document_id = $_POST['document_id'] ?? null;
	$title = $_POST['title'] ?? null;
	$post_date = $_POST['post_date'] ?? null;
	$poster_name = $_POST['poster_name'] ?? null;
	$safe_level = $_POST['safe_level'] ?? null;
	$sort = $_POST['sort'] ?? 'document_id asc';
	$sorts = array(
		'document_id' => 'asc',
		'title' => 'asc',
		'safe_level' => 'asc',
		'poster_name' => 'asc',
		'post_date' => 'asc',
		'manage_site_id' => 'asc',
		// 'likes' => 'asc'
	);
	$symbols = array(
		'document_id' => '',
		'title' => '',
		'safe_level' => '',
		'poster_name' => '',
		'post_date' => '',
		'manage_site_id' => '',
		// 'likes' => ''
	);
	$sort_parameters = explode(' ', $sort);
	$sorts[$sort_parameters[0]] = $sort_parameters[1] == 'asc' ? 'desc' : 'asc';
	$symbols[$sort_parameters[0]] = $sort_parameters[1] == 'asc' ? ' ▲' : ' ▼';

	$sql_cmd = "select document_id, title, content, safe_level, post_date, user.name as poster_name, site.name as site_name ".
			   "from document, user, site ".
			   "where document.poster_id = user.user_id and document.manage_site_id = site.site_id";
	if(!is_null($document_id) && $document_id != ''){
		$sql_cmd .= " and document_id = '$document_id'";
	}
	if(!is_null($title) && $title != ''){
		$sql_cmd .= " and title = '$title'";
	}
	if(!is_null($post_date) && $post_date != ''){
		$sql_cmd .= " and post_date = '$post_date'";
	}
	if(!is_null($poster_name) && $poster_name != ''){
		$sql_cmd .= " and user.name = '$poster_name'";
	}
	if(!is_null($safe_level) && $safe_level != ''){
		$safe_level_id = array(
			"Safe" => "1", "Euclid" => "2", "Keter" => "3"
		);
		$sql_cmd .= " and safe_level = '$safe_level_id[$safe_level]'";
	}

	$sql_cmd .= " order by $sort";
	if($sort_parameters[0] != 'document_id')
	{
		$sql_cmd .= ", document_id asc";
	}

	$documents = query($sql_cmd);
	$safe_levels = array("1" => "Safe", "2" => "Euclid", "3" => "Keter");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<link rel="stylesheet" href="search_style.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Goldman">
	</head>
	<body>
		<?php include('nav.php'); ?>
		<div>
			<div>
				<h1>Document Searching</h1>
			</div>
			<form id="form" method="post" action="search_document.php">
				<label> ID: </label>
				<input type="text" name="document_id" value="<?= $document_id ?>">
				<br><br>
				<label> Name: </label>
				<input type="text" name="title" value="<?= $title ?>">
				<br><br>
				<label> Posted Date: </label>
				<input type="date" name="post_date" value="<?= $post_date ?>">
				<br><br>
				<label> Posted User: </label>
				<input type="text" name="poster_name" value="<?= $poster_name ?>">
				<br><br>
				<label> Safe Level: </label>
				<input type="text" name="safe_level" value="<?= $safe_level ?>">
				<br><br>
				<div align="center">
					<input type="submit" id="btn_search" value="Search">
				</div>
			</form>
		</div>
		<br><br><br>
		<table>
			<thead>
				<tr>
					<th width="50px">
						<span onclick="resort('document_id <?= $sorts['document_id'] ?>')">ID<?= $symbols['document_id'] ?></span>
					</th>
					<th width="150px">
						<span onclick="resort('title <?= $sorts['title'] ?>')">Name<?= $symbols['title'] ?></span>
					</th>
					<th width="150px">
						<span onclick="resort('safe_level <?= $sorts['safe_level'] ?>')">Safe Level<?= $symbols['safe_level'] ?></span>
					</th>
					<th width="150px">
						<span onclick="resort('poster_name <?= $sorts['poster_name'] ?>')">Posted User<?= $symbols['poster_name'] ?></span>
					</th>
					<th width="150px">
						<span onclick="resort('post_date <?= $sorts['post_date'] ?>')">Posted Date<?= $symbols['post_date'] ?></span>
					</th>
					<th width="150px">
						<span onclick="resort('manage_site_id <?= $sorts['manage_site_id'] ?>')">Placed Site<?= $symbols['manage_site_id'] ?></span>
					</th>
					<!-- <th width="75px">
						<span onclick="resort('likes <?= $sorts['likes'] ?>')">Like<?= $symbols['likes'] ?></span>
					</th> -->
					<th width="50px">Detail</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach($documents as $document)
					{
					?>
						<tr>
							<td><?= $document['document_id'] ?></td>
							<td><?= $document['title'] ?></td>
							<td><?= $safe_levels[$document['safe_level']] ?></td>
							<td><?= $document['poster_name'] ?></td>
							<td><?= $document['post_date'] ?></td>
							<td><?= $document['site_name'] ?></td>
							<!-- <td><?= $document['likes'] ?></td> -->
							<td><a href="document.php?id=<?= $document['document_id'] ?>">click me</a></td>
						</tr>
					<?php
					}
				?>
			</tbody>
		</table>
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