<?php
	session_start();
	include('config.php');

	$user_check = $_SESSION['login_user'];
	if (!isset($_SESSION['login_user'])) {
		header("location: login.php");
		die();
	}
	else{
		$ses_sql = mysqli_query($conn,"select * from student_details where regno = '$user_check' ");

		$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

		if (!mysqli_num_rows($ses_sql)>0) {
			header("location: login.php");
			die();
		}
	}

	
?>