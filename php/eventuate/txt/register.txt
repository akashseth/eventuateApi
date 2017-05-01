<?php

	#PHP script for registration

	require "init.php";

	$newUserType=$_POST['newUserType'];
	$newUserEmailId=$_POST['newUserEmailId'];


	# checking whether the input newUserEmailId already exists or not
	$query = "select `email_id` from `users` where `email_id` like '$newUserEmailId';";
	$result=mysqli_query($con, $query);

	$row=mysqli_fetch_array($result);
	if($row[0])
	{
		# user already exists
		echo "User already exists....";
	}
	else
	{
		# registration

		# Generating PASSCODE 
		exec('generate_passcode.exe');
		$file = fopen("passcode.txt", "r");
		$newUserPasscode=fread($file, 4);
		fclose($file);

		# insert code for sending this passcode to emailId
		
		echo json_encode(array("newUserEmailId" => $newUserEmailId, "newUserPasscode" => $newUserPasscode, "newUserType" => $newUserType));
	}

?>

	