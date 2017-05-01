<?php

	#PHP script for extracting the expenditure details of the organizer

	require "init.php";

	$EmailId=$_POST['EmailId'];

	$table_name = "expenditure_".$EmailId;

	$query = "select * from `eventuate`.`$table_name` order by `date` desc;";

	$result = mysqli_query($con, $query);

	if($row = mysqli_fetch_array($result))
	{
		$expenditure = array();
	
		
		do
		{
			$date = date("d-m-Y", strtotime($row[1]));

			array_push($expenditure, array("sno" => $row[0], "date" => $date, "amount" => $row[2], "details" => $row[3]));
		}while($row = mysqli_fetch_array($result));

		echo json_encode(array("expenditure" => $expenditure ));
	
	}
	else
	{
		echo "No expenditure found";
	}


?> 