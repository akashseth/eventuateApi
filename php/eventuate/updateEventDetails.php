<?php

	#PHP script for updating the event details

	require "init.php";

	$drawerFlag=$_POST['DrawerFlag'];
	$EmailId=$_POST['Email'];
	$EventType=$_POST[EventType];
	$EventDateDayOfMonth=$_POST['EventDateDayOfMonth'];
	$EventDateMonth=$_POST['EventDateMonth'];
	$EventDateYear=$_POST['EventDateYear'];
	$EventTimeFromHours=$_POST['EventTimeFromHours'];
	$EventTimeFromMinutes=$_POST['EventTimeFromMinutes'];
	$EventTimeToHours=$_POST['EventTimeToHours'];
	$EventTimeToMinutes=$_POST['EventTimeToMinutes'];
	$EventBudget=$_POST['EventBudget'];



	if ($drawerFlag == "false")
	{
		# creating a table for the information of the expenditure details of the organizer
		$table_name = "expenditure_".$EmailId;

		$query = "create table `eventuate`.`$table_name`
	  	  	  (
				`sno` integer(10) primary key,
				`date` date,
				`amount` integer(6),
				`details` varchar(500)
	  	  	  );";

		$result = mysqli_query($con, $query);


		# creating a table for the information of the bookings made by the organizer
		$table_name = "bookings_".$EmailId;

		$query = "create table `eventuate`.`$table_name`
	  	  	  (
				
				`sno` integer(10) primary key,
				`date` date,
				`type_service` varchar(50),
				`name_serviceprovider` varchar(100),
				`service_specification` varchar(100),
				`amount_paid` integer(6),
				`amount_due` integer(6)
	  	  	  );";

		$result = mysqli_query($con, $query);


		# inserting the event data into the database
		$query = "insert into `eventuate`.`event_details` (`email_id`, `eventtype`, `eventdatedayofmonth`, `eventdatemonth`, `eventdateyear`, `eventtimefromhours`, `eventtimefromminutes`, `eventtimetohours`, `eventtimetominutes`, `eventbudget`, `totalexpenditure`, `budgetleft`) values('$EmailId', '$EventType', '$EventDateDayOfMonth', '$EventDateMonth', '$EventDateYear', '$EventTimeFromHours', '$EventTimeFromMinutes', '$EventTimeToHours', '$EventTimeToMinutes', '$EventBudget', '0', '$EventBudget');";
	}
	elseif ($drawerFlag == "true")
	{
		# updating the event data into the database

		$query="select `totalexpenditure` from `eventuate`.`event_details` where `event_details`.`email_id` like '$EmailId';";
		$result=mysqli_query($con, $query);
		$row=mysqli_fetch_array($result);
		$BudgetLeft=$EventBudget-$row[0];

		$query = "update `eventuate`.`event_details` set `email_id`='$EmailId', `eventtype`='$EventType', `eventdatedayofmonth`='$EventDateDayOfMonth', `eventdatemonth`='$EventDateMonth', `eventdateyear`='$EventDateYear', `eventtimefromhours`='$EventTimeFromHours', `eventtimefromminutes`='$EventTimeFromMinutes', `eventtimetohours`='$EventTimeToHours', `eventtimetominutes`='$EventTimeToMinutes', `eventbudget`='$EventBudget', `budgetleft`='$BudgetLeft' where `event_details`.`email_id`='$EmailId';";
	}
	
	
	$result=mysqli_query($con, $query);


	$query="select `email_id` from `eventuate`.`event_details` where `email_id` like '$EmailId';";
	$result=mysqli_query($con, $query);
	$row=mysqli_fetch_array($result);

	
	if($row[0])
		echo json_encode(array("EmailId" => $row[0]));

?>

	