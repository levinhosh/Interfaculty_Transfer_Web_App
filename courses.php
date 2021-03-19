<?php 

	include "config.php";

	$data = "";

	if (isset($_POST["faculty"])) {

		$sel = $_POST['faculty'];

		if ($sel == "all") {
			$query = "SELECT * FROM courses";
			// $query = "SELECT * FROM courses WHERE faculty = 'fset' ";
			$result =mysqli_query($conn, $query);
			$counter =1;
			while ($row = mysqli_fetch_assoc($result)) {
				
				$data .= "<tr><td width='15'>".$counter."</td><td width='96'>".$row['coursename']."</td><td width='35'>".$row['cluster_point']."</td><td width='35'>".$row['faculty']."</td></tr>";
				$counter ++;
			}
		}
		else{
			$query = "SELECT * FROM courses WHERE faculty = '$sel' ";
			// $query = "SELECT * FROM courses WHERE faculty = 'fset' ";
			$result =mysqli_query($conn, $query);
			$counter =1;
			 // $data .+ "<tr><td width='45'>No</td><td width='76'>Course</td><td width='85'>Cluster</td></tr>";
			while ($row = mysqli_fetch_assoc($result)) {
				
				$data .= "<tr><td width='15'>".$counter."</td><td width='96'>".$row['coursename']."</td><td width='35'>".$row['cluster_point']."</td><td width='35'>".$row['faculty']."</td></tr>";
				$counter ++;
			}

		}
			}

	echo $data;

?>