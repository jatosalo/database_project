<?php
	//check these
	$servername = "";//localhost
	$username = "";//root
	$password = "";//rootroot
	$db_name = "";//SCP Foundation

	$conn = new mysqli($servername,$username,$password,$db_name);
	//if need port
	//$conn = new mysqli($servername,$username,$password,$db_name,port);

	if($conn->connect_error){
		die("Connection failed".$conn->connect_error);
	}
?>