<?php
	include("connection.php");

	$document_id = $_POST['document_id'] ?? null;
	$title = $_POST['title'] ?? null;
	$post_date = $_POST['post_date'] ?? null;
	$poster_name = $_POST['poster_name'] ?? null;
	$safe_level = $_POST['safe_level'] ?? null;
	$sort = $_POST['sort'] ?? 'document_id asc';
	print_r($_POST);
	$sorts = array(
		'document_id' => 'asc',
		'title' => 'asc',
		'safe_level' => 'asc',
		'poster_name' => 'asc',
		'post_date' => 'asc',
		'manage_site_id' => 'asc',
		'likes' => 'asc'
	);
	$sort_parameters = explode(' ', $sort);
	$sorts[$sort_parameters[0]] = $sort_parameters[1] == 'asc' ? 'desc' : 'asc';
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<link rel="stylesheet" href="search_style.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Goldman">
	</head>
	<body>
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
				<!-- <label> Sort By: </label>
				<select name="sort">
					<option value="document_id asc" <?= $sort == 'document_id asc' ? 'selected' : '' ?>>ID</option>
					<option value="title asc" <?= $sort == 'title asc' ? 'selected' : '' ?>>User</option>
					<option value="post_date asc" <?= $sort == 'post_date asc' ? 'selected' : '' ?>>Date</option>
					<option value="manage_site_id asc" <?= $sort == 'manage_site_id asc' ? 'selected' : '' ?>>Site</option>
					<option value="safe_level asc" <?= $sort == 'safe_level asc' ? 'selected' : '' ?>>Level</option>
					<option value="likes asc" <?= $sort == 'likes asc' ? 'selected' : '' ?>>Liked</option>
					<option value="document_id desc" <?= $sort == 'document_id desc' ? 'selected' : '' ?>>ID (desc)</option>
					<option value="title desc" <?= $sort == 'title desc' ? 'selected' : '' ?>>User (desc)</option>
					<option value="post_date desc" <?= $sort == 'post_date desc' ? 'selected' : '' ?>>Date (desc)</option>
					<option value="manage_site_id desc" <?= $sort == 'manage_site_id desc' ? 'selected' : '' ?>>Site (desc)</option>
					<option value="safe_level desc" <?= $sort == 'safe_level desc' ? 'selected' : '' ?>>Level (desc)</option>
					<option value="likes desc" <?= $sort == 'likes desc' ? 'selected' : '' ?>>Liked (desc)</option>
				</select>
				<br><br> -->
				<div align="center">
					<input type="submit" id="btn_search" value="Search">
				</div>
			</form>
		</div>
		<br><br><br>
		<table>
			<thead>
				<tr>
					<!-- todo: add cursor: pointer, and arrow to show asc/desc -->
					<th width="50px" onclick="resort('document_id <?= $sorts['document_id'] ?>')">ID</th>
					<th width="150px" onclick="resort('title <?= $sorts['title'] ?>')">Name</th>
					<th width="150px" onclick="resort('safe_level <?= $sorts['safe_level'] ?>')">Safe Level</th>
					<th width="150px" onclick="resort('poster_name <?= $sorts['poster_name'] ?>')">Posted User</button></th>
					<th width="150px" onclick="resort('post_date <?= $sorts['post_date'] ?>')">Posted Date</th>
					<th width="150px" onclick="resort('manage_site_id <?= $sorts['manage_site_id'] ?>')">Placed Site</th>
					<th width="50px" onclick="resort('likes <?= $sorts['likes'] ?>')">Like</th>
					<th width="50px">Detail</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$sql_cmd = "select document_id, title, content, safe_level, post_date, user.name as poster_name, site.name as site_name, ".
								"(select count(*) from like_document where document.document_id = like_document.document_id) as likes ".
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
						$sql_cmd .= " and safe_level = '$safe_level'";
					}

					if ($sort == 'document_id desc' || $sort == 'document_id asc')
					{
						$sql_cmd .= " order by $sort";
					}
					else
					{
						$sql_cmd .= " order by $sort, document_id asc";
					}
					echo $sql_cmd;

					$result = mysqli_query($conn, $sql_cmd);
					$safe_level = array(1 => "Safe", 2 => "Euclid", 3 => "Keter");
					foreach($result as $row)
					{
					?>
						<tr>
							<td><?= $row['document_id'] ?></td>
							<td><?= $row['title'] ?></td>
							<td><?= $safe_level[$row['safe_level']] ?></td>
							<td><?= $row['poster_name'] ?></td>
							<td><?= $row['post_date'] ?></td>
							<td><?= $row['site_name'] ?></td>
							<td><?= $row['likes'] ?></td>
							<td><a href="<?= $row['content'] ?>">click me</a></td>
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