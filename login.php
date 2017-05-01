<?php

	#PHP script for extracting the user and event details

	require "init.php";

	$EmailId=$_POST['EmailId'];


	$query = "select * from `eventuate`.`profile_organizer` where `profile_organizer`.`email_id`='$EmailId';";
	$result=mysqli_query($con, $query);
	$row=mysqli_fetch_array($result);
		
	$OrganizerName=$row[1];
	$OrganizerMob=$row[2];
	$OrganizerAddress=$row[3];


	$query = "select * from `eventuate`.`event_details` where `event_details`.`email_id`='$EmailId';";
	$result=mysqli_query($con, $query);
	$row=mysqli_fetch_array($result);

	$EventType=$row[1];
	$EventDateDayOfMonth=$row[2];
	$EventDateMonth=$row[3];
	$EventDateYear=$row[4];
	$EventTimeFromHours=$row[5];
	$EventTimeFromMinutes=$row[6];
	$EventTimeToHours=$row[7];
	$EventTimeToMinutes=$row[8];
	$EventBudget=$row[9];
	$TotalExpenditure=$row[10];
	$BudgetLeft=$row[11];
	
	if($OrganizerName==null)
		$OrganizerProfileInput=false;
	else
		$OrganizerProfileInput=true;

	if($EventType==null)
		$OrganizerEventInput=false;
	else
		$OrganizerEventInput=true;


	
	echo json_encode(array("EmailId"=>$EmailId, "OrganizerProfileInput"=>$OrganizerProfileInput, "OrganizerEventInput"=>$OrganizerEventInput, "OrganizerName"=>$OrganizerName, "OrganizerMob"=>$OrganizerMob, "OrganizerAddress"=>$OrganizerAddress, "EventType"=>$EventType, "EventDateDayOfMonth"=>$EventDateDayOfMonth, "EventDateMonth"=>$EventDateMonth, "EventDateYear"=>$EventDateYear, "EventTimeFromHours"=>$EventTimeFromHours, "EventTimeFromMinutes"=>$EventTimeFromMinutes, "EventTimeToHours"=>$EventTimeToHours, "EventTimeToMinutes"=>$EventTimeToMinutes, "EventBudget"=>$EventBudget, "TotalExpenditure"=>$TotalExpenditure, "BudgetLeft"=>$BudgetLeft));
?>