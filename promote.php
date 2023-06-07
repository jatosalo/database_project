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

	$id = $_GET['id'] ?? null;
	if(!is_null($id))
	{
		$site_id = query("select site_id from administrator where user_id = '$user_id'");
		$site_id = fetch_all($site_id)[0]['site_id'];
		query("delete from common_user where user_id = '$id'");
		query("insert into administrator values ('$id', '$site_id')");
	}

	$user_id = $_POST['user_id'] ?? null;
	$name = $_POST['name'] ?? null;
	$sort = $_POST['sort'] ?? 'user_id asc';
	$sorts = array(
		'user_id' => 'asc',
		'name' => 'asc'
	);
	$symbols = array(
		'user_id' => '',
		'name' => ''
	);
	$sort_parameters = explode(' ', $sort);
	$sorts[$sort_parameters[0]] = $sort_parameters[1] == 'asc' ? 'desc' : 'asc';
	$symbols[$sort_parameters[0]] = $sort_parameters[1] == 'asc' ? ' ▲' : ' ▼';

	$sql_cmd = "select user.user_id as user_id, name from user, common_user where user.user_id = common_user.user_id";
	if(!is_null($user_id) && $user_id != ''){
		$sql_cmd .= " and user_id = '$user_id'";
	}
	if(!is_null($name) && $name != ''){
		$sql_cmd .= " and name = '$name'";
	}

	$sql_cmd .= " order by $sort";
	if($sort_parameters[0] != 'user_id')
	{
		$sql_cmd .= ", user_id asc";
	}

	$users = query($sql_cmd);
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
				<h1>Common User Promote</h1>
			</div>
			<form id="form" method="post" action="promote.php">
				<label>ID:</label>
				<input type="text" name="user_id" value="<?= $user_id ?>">
				<br><br>
				<label> Name: </label>
				<input type="text" name="name" value="<?= $name ?>">
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
						<span onclick="resort('user_id <?= $sorts['user_id'] ?>')">ID<?= $symbols['user_id'] ?></span>
					</th>
					<th width="50px">
						<span onclick="resort('name <?= $sorts['name'] ?>')">Name<?= $symbols['name'] ?></span>
					</th>
					<th width="50px">Promote</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach($users as $user)
					{
					?>
						<tr>
							<td><?= $user['user_id'] ?></td>
							<td><?= $user['name'] ?></td>
							<td><a href="promote.php?id=<?= $user['user_id'] ?>">Promote</a></td>
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