<?php

	#PHP script for extracting the booking details of the organizer

	require "init.php";

	$EmailId=$_POST['EmailId'];

	$table_name = "bookings_".$EmailId;

	$query = "select * from `eventuate`.`$table_name` order by `date` desc;";

	$result = mysqli_query($con, $query);

	if($row = mysqli_fetch_array($result))
	{
		$bookings = array();
	
		
		do
		{
			$date = date("d-m-Y", strtotime($row[1]));

			array_push($bookings, array("sno" => $row[0], "date" => $date, "type_service" => $row[2], "name_serviceprovider" => $row[3], "service_specification" => $row[4], "amount_paid" => $row[5], "amount_due" => $row[6]));
		}while($row = mysqli_fetch_array($result));

		echo json_encode(array("bookings" => $bookings ));
	
	}
	else
	{
		echo "No Bookings";
	}


?> 