<?php

	#php script for connecting to the database EVENTUATE

	$username="root";
	$password="";
	$host="localhost";
	$db="eventuate";

	$con=mysqli_connect($host, $username, $password, $db);

	if(!$con)
		echo "Database Connection Error...".mysqli_connect_error();

?>