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

	$id = $_GET['id'] ?? null;
	if(is_null($id))
	{
		header('Location: search_document.php');
		exit();
	}

	$msg = $_POST['msg'] ?? null;
	if(!is_null($msg) && $msg != '')
	{
		$post_time = date('Y-m-d H:i:s');
		query("insert into message (content, post_time, poster_id, document_id) values ('$msg', '$post_time', '$user_id', '$id')");
	}

	$document = query("select title, content from document where document_id = '$id'");
	$document = fetch_all($document)[0];

	$messages = query("select content, post_time, name from message, user where poster_id = user_id and document_id = '$id'");
	$messages = fetch_all($messages);
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" href="document_style.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Goldman">
</head>
<body>
	<!-- <div id="img1">
		<img id="img_likes" src="images/like.png" width="40px" height="40px" onclick="changeImage()">
	</div> -->
	<div id="form">
		<form action="http://scp-zh-tr.wikidot.com/scp-<?= $id ?>" method="post"></form>
			<div align="center">
				<input type="submit" id="btn_login" value = "SCP-<?= $id ?>">
				<br>
				<div id="form_topic"><h1><?= $document['title'] ?></h1></div>
			</div>
		</form>
	</div>
	<div id="message">
		<div align="left">
			<h1>Content</h1>
		</div>
		<p><?= $document['content'] ?></p>
		<div align="left">
			<h1>Message</h1>
		</div>
		<form action="document.php?id=<?=$id?>" method="post">
			<label>Add message:</label>
			<br>
			<textarea name="msg" rows="5" cols="162"></textarea>
			<br><br>
			<div align="right">
				<input type="submit" id="btn_sent" value="Sent">
			</div>
		</form>
		<?php
		foreach($messages as $message)
		{
		?>
			<p>
				<?= $message['post_time'] ?>
				<br>
				<?= $message['name'] ?> : <?= $message['content'] ?>
			</p>
		<?php
		}
		?>
	</div>
	<!-- <script language="javascript">
    var a = 1;
    function changeImage() {
        if (a==1) 
        {
            document.getElementById("img_likes").src = "images/like.png";
            a+=1;
        }
        else if (a==2) 
        {
            document.getElementById("img_likes").src = "images/not_like.png";
            a-=1;
        }
    }
    </script> -->
</body>
</html>