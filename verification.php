<?php

	#PHP script for user verification

	require "init.php";

	$EmailId=$_POST['Email'];
	$Passcode=$_POST['Passcode'];


	# extracting the user info for verification
	$query = "select * from `eventuate`.`users` where `users`.`email_id` like '$EmailId';";
	$result=mysqli_query($con, $query);

	$row=mysqli_fetch_array($result);

	
	if($row['EMAIL_ID'] != "")
		echo json_encode(array("EmailId" => $row['EMAIL_ID'], "UserType" => $row['USER_TYPE'], "PassCode" => $row['PASSCODE'], "userId" => $row['id']));
	
?>

	