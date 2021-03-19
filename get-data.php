<?php
	include "config.php";

	$options = "";

	$faculty = $_POST["selected"];

	$sql = "SELECT * from courses where faculty='$faculty' ";
	$courses_res = mysqli_query($conn, $sql);
	if (!mysqli_num_rows($courses_res) > 0) {
	 echo "<p>NO DATA</p>";
	}
	else{
		$options .= "<option value ='None'>--select course--</option>";
		while ($row = mysqli_fetch_assoc($courses_res)) {

			$options .= "<option value = ".$row['id']." >".$row["coursename"]."</option>";
		}
	}


	echo $options;


 ?>
