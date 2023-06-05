<?php
	$user_account = "jatosalo";
	setcookie( "u_acc", $user_account,time()+3600);
	header("Location:welcome.php");
?>