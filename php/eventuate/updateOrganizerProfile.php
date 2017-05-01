<?php

	#PHP script for updating the user profile

	require "init.php";

	$drawerFlag=$_POST['DrawerFlag'];
	$EmailId=$_POST['Email'];
	$Name=$_POST['Name'];
	$Mob=$_POST['Mob'];
	$Address=$_POST['Address'];


	if ($drawerFlag == "false")
	{
		# inserting the profile data into the database
		$query = "insert into `eventuate`.`profile_organizer` (`email_id`, `name`, `mob`, `address`) values('$EmailId', '$Name', '$Mob', '$Address');";
	}
	elseif ($drawerFlag == "true")
	{
		# updating the profile data into the database
		$query = "update `eventuate`.`profile_organizer` set `name`='$Name', `mob`='$Mob', `address`='$Address' where `profile_organizer`.`email_id`='$EmailId';";
	}
	
	
	$result=mysqli_query($con, $query);


	$query="select `email_id` from `eventuate`.`profile_organizer` where `email_id` like '$EmailId';";
	$result=mysqli_query($con, $query);
	$row=mysqli_fetch_array($result);

	
	if($row[0])
		echo json_encode(array("EmailId" => $row[0]));
	
?>

	