<?php

	include "session.php";

	$user_data = $_SESSION["data"];
	$option1 = $_POST["selectedcourse1"]; // id if first option
	$option2 = $_POST["selectedcourse2"]; // id of second option
// checking if any of options selected is same as current course
	$error = 0;
	if ($user_data["course"] == $option1) {
		$error = 1;
	}
	if ($user_data["course"] == $option2) {
		$error = 1;
	}
// displaying error message to user if option is same as current course
	if ($error == 1) {
		echo "<script>alert('You cannot transfer to your current course'</script>";
	}
	else{

		$row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM courses WHERE id = $option1")); // data about first option
		$coursename1 = $row["coursename"];

		$row2 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM courses WHERE id = $option2")); // data about second option
		$coursename2 = $row2["coursename"];

		if ($option1 >= $option2) {
			$toselect= $option1;
		}
		else{
			$toselect = $option2;
		}

		if ($toselect > $user_data["cluster_points"]) {
			header("location: profile.php?submitted=notpermitted");
		}


		if ($user_data["cluster_points"] >= $toselect) {
			$query = "INSERT INTO submitted_applications(reg_no, first_option_course, second_option_course)
			VALUES ('".$user_data["regno"]."', '$coursename1', '$coursename2' )";

			if (mysqli_query($conn, $query)) {

				$query2 = "UPDATE student_details SET course = ".$toselect." WHERE regno = '".$user_data['regno']."' ";
				if (mysqli_query($conn, $query2)) {
					header("location: profile.php?changed=success");
				}
				else{
					header("location: profile.php?submitted=error");
				}
			}
			else{
				header("location: profile.php?submitted=error");
			}
		}
		else{
			header("location: profile.php?submitted=notpermitted");
		}




	}


?>
