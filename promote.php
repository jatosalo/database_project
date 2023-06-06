<?php
	//include("connection.php");
	if(isset($_GET['acc'] )){
		/*
		TODO: sql change
		將此account($_GET['acc']) 轉成adminstrator
		*/

	}
	$account = $_POST['document_id'] ?? null;
	$name = $_POST['title'] ?? null;
	$messages = $_POST['post_date'] ?? null;
	$likes = $_POST['poster_name'] ?? null;
	$sort = $_POST['sort'] ?? 'account asc';
	print_r($_POST);
	$sorts = array(
		'account' => 'asc',
		'name' => 'asc',
		'messages' => 'asc',
		'likes' => 'asc'
	);
	$sort_parameters = explode(' ', $sort);
	$sorts[$sort_parameters[0]] = $sort_parameters[1] == 'asc' ? 'desc' : 'asc';
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<link rel="stylesheet" href="promote_style.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Goldman">
	</head>
	<body>
		<div>
			<div>
				<h1>Common User Promote</h1>
			</div>
			<form id="form" method="post" action="promote.php">
				<label> Account: </label>
				<input type="text" name="account" value="<?= $account ?>">
				<br><br>
				<label> Name: </label>
				<input type="text" name="name" value="<?= $name ?>">
				<br><br>
				<label> Messages: </label>
				<input type="text" name="messages" value="<?= $messages ?>">
				<br><br>
				<label> Likes: </label>
				<input type="text" name="likes" value="<?= $likes ?>">
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
					<!-- todo: add cursor: pointer, and arrow to show asc/desc -->
					<th width="150px" onclick="resort('account <?= $sorts['account'] ?>')">Account</th>
					<th width="50px" onclick="resort('name <?= $sorts['name'] ?>')">Name</th>
					<th width="50px" onclick="resort('messages <?= $sorts['messages'] ?>')">Messages</th>
					<th width="50px" onclick="resort('likes <?= $sorts['likes'] ?>')">Like</th>
					<th width="50px">Promote</th>
				</tr>
			</thead>
			<tbody>
				<?php
					/*
						TODO:
						List all common user
						hint : list by : account, name, messages(留過的message數), likes(like documents數)
					*/

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

					//$result = mysqli_query($conn, $sql_cmd);
					//$safe_level = array(1 => "Safe", 2 => "Euclid", 3 => "Keter");
					//foreach($result as $row)
					//{
					?>
						<tr>
							<td><?= 1//$row['account'] ?></td>
							<td><?= 2//$row['name'] ?></td>
							<td><?= 3//$row['messages'] ?></td>
							<td><?= 4//$row['likes'] ?></td>



							<td><a href="<?= "promote.php?acc=" . "1"//. $row['account'] ?>">promote</a></td>


						</tr>
					<?php
					//}
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