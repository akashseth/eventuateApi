<?php

	#PHP script for registration

	require "init.php";

	$newUserType=$_POST['newUserType'];
	$newUserEmailId=$_POST['newUserEmailId'];


	# checking whether the input newUserEmailId already exists or not
	$query = "select `email_id` from `users` where `email_id` like '$newUserEmailId';";
	$result=mysqli_query($con, $query);

	$row=mysqli_fetch_array($result);
	if($row['email_id'])
	{
		# user already exists
		echo "User already exists....";
	}
	else
	{
		# registration

		# Generating PASSCODE 
		//exec('generate_passcode.exe');
		//$file = fopen("passcode.txt", "r");
		$newUserPasscode=  rand(1000, 10000);
                
                $to = $newUserEmailId;
                $subject = 'Email Verification';
                $message = 'Your passcode is '.$newUserPasscode.'. Please do not delete this email.'; 
              
                // Sending email
                mail($to, $subject, $message);
		//fclose($file);

		# insert code for sending this passcode to emailId
		
		echo json_encode(array("newUserEmailId" => $newUserEmailId, "newUserPasscode" => $newUserPasscode, "newUserType" => $newUserType));
	}

?>

	