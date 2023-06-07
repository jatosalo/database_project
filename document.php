<?php
	//include("connection.php");
	$did = "000";
	$origin_did = "";
	if(isset($_GET['did'])){
		/*
		TODO: sql change
		將此account($_GET['acc']) 轉成adminstrator
		*/
		$did = $_GET['did'];
		$origin_did = $_GET['did'];
		if($did < 10){
			$did = "00" . $did;
		}
		else if($did < 100){
			$did = "0" . $did;
		}
	}
	if(isset($_POST['submit'])){
		/*
			TODO : add $_POST['msg'], now_time in message table
		*/
		echo $_POST['msg'];
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" href="document_style.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Goldman">
</head>
<body>
	<div id = "img1">
		<img id = "img_likes" src="images/like.png" width="40px" height="40px" onclick="changeImage()">
	</div>
	<div id = "form">
		<div id = "form_topic"><h1>Allowed to Access</h1></div>
		<br>
		<?php
			echo "<form name = 'form' action = 'http://scp-zh-tr.wikidot.com/scp-";
			echo $did;
			echo "' method = 'POST'>";
		?>
			<div align = "center">
			<input type = "submit" id = "btn_login" value = "SCP-<?=$did?>" name = "submit" style="width:400px;height:80px; font-family: 'Goldman';">
			</div>
		</form>

	</div>
	<br><br>
	<div id = "message">
		<div align = "left">
			<div id = "content_topic"><h1>Content</h1></div>
		</div>
		
		<!-- content -->
		<p>never gonna give you up.</p>


		<div align = "left">
			<div id = "message_topic"><h1>Message</h1></div>
		</div>

		<!--
			TODO : connect to sql
			loop:
				echo "<p>[post_date]<br>[user_name] : [content]</p>" 
		-->
		<form name = "form" action = "document.php?did=<?=$origin_did?>" method = "POST">
			<label> Add message: </label><br>
			<textarea id = "msg" name = "msg" rows="5" cols="162"></textarea><br><br>
			<div align = "right">
			<input type = "submit" id = "btn_sent" value = "Sent" name = "submit" style="width:200px;height:40px; font-family: 'Goldman';">
			</div>
		</form>
		<p>2023/06/07 22:12<br>Bright : LMAO</p>
		<p>2023/06/07 22:11<br>Kondraki : Fuck you, Bright.</p>
		<p>2023/06/07 22:11<br>Gears : Fuck you, Bright.</p>
		<p>2023/06/07 22:11<br>Clef : Fuck you, Bright.</p>
		<p>2023/06/07 22:10<br>Bright : No bruh, definitely SCP-963.</p>
		<p>2023/06/07 22:07<br>Kondraki : Do you mean SCP-408?</p>
		<p>2023/06/07 22:05<br>Gears : Something new.</p>
		<p>2023/06/07 22:04<br>Clef : What's this?</p>

		
		<br><br><br><br><br><br><br><br>
	</div>
	<script language="javascript">
	/*
	TODO : connect to like
	below shown as a flip-flop sample
	*/

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
    </script>
</body>
</html>