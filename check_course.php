<?php 

	include "config.php";
	$selected = $_POST["selected"];
	$current = $_POST["current"];

	$row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM courses WHERE id = $selected"));
	if($row["coursename"] === $current){
		echo 1;
	}

 ?>