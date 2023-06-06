<?php
	include("connection.php");
	if(isset($_POST['submit'])){
		$user_account = $_POST['user'];
		$password = $_POST['pass'];
		$sql = "select account,password from user where account = '$user_account' and password = '$password'";
		$result = mysqli_query($conn,$sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$count = mysqli_num_rows($result);
		if($count == 1){
			session_start();
			$_SESSION["u_acc"] = $user_account;
			header("Location:welcome.php");
		}
		else{
			echo '<script>
				window.location.href = "login.php";
				alert("Login Failed!");
				</script>';
		}
	}
?>