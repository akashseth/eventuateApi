<?php

	#PHP script for inserting the new user Email, UserType and Passcode into the database which completes the registraton process

	require "init.php";

	$EmailId=$_POST['Email'];
	$UserType=$_POST['UserType'];
	$Passcode=$_POST['Passcode'];


	# inserting the new user data into the database
	$query = "insert into `users` values('$EmailId', '$UserType', '$Passcode');";
	$result=mysqli_query($con, $query);


	# extracting the EmailId for the json response
	$query = "select `email_id` from `users` where `email_id` like '$EmailId';";
	$result=mysqli_query($con, $query);

	$row=mysqli_fetch_array($result);

	if(!$row[0])
		echo "Error...";
	else
		echo json_encode(array("EmailId" => $row[0]));
	
?>

	