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

	$site_id = $_POST['site_id'] ?? null;
	$name = $_POST['name'] ?? null;
	$start_date = $_POST['start_date'] ?? null;
	$manager_name = $_POST['manager_name'] ?? null;
	$location = $_POST['location'] ?? null;
	$sort = $_POST['sort'] ?? 'site_id asc';

	$sorts = array(
		'site_id' => 'asc',
		'name' => 'asc',
		'start_date' => 'asc',
		'manager_name' => 'asc'
	);
	$symbols = array(
		'site_id' => '',
		'name' => '',
		'start_date' => '',
		'manager_name' => ''
	);
	$sort_parameters = explode(' ', $sort);
	$sorts[$sort_parameters[0]] = $sort_parameters[1] == 'asc' ? 'desc' : 'asc';
	$symbols[$sort_parameters[0]] = $sort_parameters[1] == 'asc' ? ' ▲' : ' ▼';

	$sql_cmd = "select site_id, site.name as name, start_date, location, user.name as manager_name ".
			   "from site, user ".
			   "where site.manager_id = user.user_id";
	if(!is_null($site_id) && $site_id != ''){
		$sql_cmd .= " and site_id = '$site_id'";
	}
	if(!is_null($name) && $name != ''){
		$sql_cmd .= " and site.name = '$name'";
	}
	if(!is_null($start_date) && $start_date != ''){
		$sql_cmd .= " and start_date = '$start_date'";
	}
	if(!is_null($manager_name) && $manager_name != ''){
		$sql_cmd .= " and user.name = '$manager_name'";
	}
	if(!is_null($location) && $location != ''){
		$sql_cmd .= " and location like '%$location%'";
	}

	$sql_cmd .= " order by $sort";
	if($sort_parameters[0] != 'site_id')
	{
		$sql_cmd .= ", site_id asc";
	}

	$sites = query($sql_cmd);
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
				<h1>Site Searching</h1>
			</div>
			<form id="form" method="post" action="search_site.php">
				<label> ID: </label>
				<input type="text" name="site_id" value="<?= $site_id ?>">
				<br><br>
				<label> Name: </label>
				<input type="text" name="name" value="<?= $name ?>">
				<br><br>
				<label> Start Date: </label>
				<input type="date" name="start_date" value="<?= $start_date ?>">
				<br><br>
				<label> Manage User: </label>
				<input type="text" name="manager_name" value="<?= $manager_name ?>">
				<br><br>
				<label> Location: </label>
				<input type="text" name="location" value="<?= $location ?>">
				<br><br>
				<div align="center">
					<input type="submit" value="Search">
				</div>
			</form>
		</div>
		<br><br><br>
		<table>
			<thead>
				<tr>
					<th width="50px">
						<span onclick="resort('site_id <?= $sorts['site_id'] ?>')">ID<?= $symbols['site_id'] ?></span>
					</th>
					<th width="75px">
						<span onclick="resort('name <?= $sorts['name'] ?>')">Name<?= $symbols['name'] ?></span>
					</th>
					<th width="75px">
						<span onclick="resort('manager_name <?= $sorts['manager_name'] ?>')">Manager User<?= $symbols['manager_name'] ?></span>
					</th>
					<th width="100px">
						<span onclick="resort('start_date <?= $sorts['start_date'] ?>')">Start Date<?= $symbols['start_date'] ?></span>
					</th>
					<th width="200px">Location</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach($sites as $site)
					{
					?>
						<tr>
							<td><?= $site['site_id'] ?></td>
							<td><?= $site['name'] ?></td>
							<td><?= $site['manager_name'] ?></td>
							<td><?= $site['start_date'] ?></td>
							<td><?= $site['location'] ?></td>
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