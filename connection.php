<?php
	$connect = new mysqli("127.0.0.1", "root", "", "scp");

	if($connect->connect_error){
		die("Connection failed" . $connect->connect_error);
	}

	function query($sql_cmd)
	{
		global $connect;
		return mysqli_query($connect, $sql_cmd);
	}

	function fetch_all($result)
	{
		return mysqli_fetch_all($result, MYSQLI_ASSOC);
	}
?>