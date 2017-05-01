<?php

	#PHP script for extracting the expenditure details of the organizer

	require "init.php";

	$EmailId=$_POST['EmailId'];
	$Flag=$_POST['Flag'];
	$Sno=$_POST['Sno'];
	$date=$_POST['Date'];
	$Amount=$_POST['Amount'];
	$Details=$_POST['Details'];
	$OldAmount=$_POST['OldAmount'];


	$table_name = "expenditure_".$EmailId;

	#converting date to a proper format
	$Date = date("Y-m-d", strtotime($date));


	#updating the budget info in the event_details table
	$query = "select * from `eventuate`.`event_details` where `event_details`.`email_id` like '$EmailId';";
	$result = mysqli_query($con, $query);
	$row = mysqli_fetch_array($result);
	if($row[0])
	{
		$totalExpenditure=$row['totalexpenditure'];
		$budgetLeft=$row['budgetleft'];
	}
	

	$expenditure = $totalExpenditure-$OldAmount+$Amount;
	$left = $budgetLeft+$OldAmount-$Amount;

	$query = "update `eventuate`.`event_details` set `totalexpenditure`='$expenditure', `budgetleft`='$left' where `event_details`.`email_id`='$EmailId';";
	$result = mysqli_query($con, $query);


	#if $Flag==true => update expenditure, elae if $Flag==false => add expenditure 
	if($Flag=="true")
	{
		$query = "update `eventuate`.`$table_name` set `date`='$Date', `amount`='$Amount', `details`='$Details' where `$table_name`.`sno`='$Sno';";
	}
	elseif($Flag=="false")
	{
		#extracting the no. of entries in the table `eventuate`.`$table_name` and hence setting the sno for the new entry
		$query = "select * from `eventuate`.`$table_name`;";
		$result = mysqli_query($con, $query);
		$Sno = mysqli_num_rows($result)+1;

		$query = "insert into `eventuate`.`$table_name` (`sno`, `date`, `amount`, `details`) values('$Sno', '$Date', '$Amount', '$Details');";
	}
	

	$result = mysqli_query($con, $query);

	echo json_encode(array("EmailId" => $EmailId ));	

?> 