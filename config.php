<?php

	define("DBSERVER", "localhost");
	define("DBUSER", "levin");
	define("DBPASSWORD", "1234567890");
	define("DBNAME", "intertransfer");

	$conn = mysqli_connect(DBSERVER, DBUSER, DBPASSWORD, DBNAME);

?>
