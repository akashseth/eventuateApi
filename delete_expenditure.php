<?php

	#PHP script for deleting the expenditure details

	require "init.php";

	$EmailId=$_POST['EmailId'];
	$Sno=$_POST['Sno'];

	$table_name = "expenditure";

	$query = "select * from `eventuate`.`$table_name` where `$table_name`.`sno`='$Sno';";

	$result = mysqli_query($con, $query);
	$row = mysqli_fetch_array($result);
	$Amount=$row['amount'];

	$query = "delete from `eventuate`.`$table_name` where `$table_name`.`sno`=$Sno;";
	$result = mysqli_query($con, $query);


	#updating the budget info in the event_details table
	$query = "select * from `eventuate`.`event_details` where `event_details`.`email_id` like '$EmailId';";
	$result = mysqli_query($con, $query);
	$row = mysqli_fetch_array($result);
	if($row[0])
	{
		$totalExpenditure=$row['totalexpenditure'];
		$budgetLeft=$row['budgetleft'];
	}
	

	$expenditure = $totalExpenditure-$Amount;
	$left = $budgetLeft+$Amount;

	$query = "update `eventuate`.`event_details` set `totalexpenditure`='$expenditure', `budgetleft`='$left' where `event_details`.`email_id`='$EmailId';";
	$result = mysqli_query($con, $query);


	echo json_encode(array("EmailId" => $EmailId ));

?> 