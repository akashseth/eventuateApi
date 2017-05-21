<?php

	#PHP script for extracting the booking details of the organizer

	require "../init.php";

	$serviceProviderId=$_POST['serviceProviderId'];

	$table_name = "bookings";

	$query = "select * from `eventuate`.`$table_name` where service_provider_id = '$serviceProviderId' order by `date` desc;";

	$result = mysqli_query($con, $query);
          
	if($row = mysqli_fetch_array($result))
	{
		$bookings = array();
	
		
		do
		{
			$date = date("d-m-Y", strtotime($row['date']));
                        
                         $serviceAvailabilityId = $row['serviceAvailabilityId'];
                         $quantity = $row['quantity'];
                        // echo 'akash';
                         $query2 = "select service_id,availability_name from service_availability where id='$serviceAvailabilityId'";
                         $result2 = mysqli_query($con, $query2);
                        // mysqli_close($con);
                         if($row2 = mysqli_fetch_array($result2)) {
                             
                              $serviceId=$row2['service_id'];
                               $availabilityName=$row2['availability_name'];
                                //$serviceProviderId=$row2['service_provider_id'];
                               // echo $serviceProviderId;
                         }
                         
                      $query2 = "select ServiceName from services where id='$serviceId'";
                         $result2 = mysqli_query($con, $query2);
                         if($row2 = mysqli_fetch_array($result2)){
                             $serviceName= $row2['ServiceName'];
                         }
                        // mysqli_close($con);
                         $user_email=$row['emailId'];
                         $query2 = "select name from profile_organizer where email_id='$user_email'";
                         $result2 = mysqli_query($con, $query2);
                         if($row2 = mysqli_fetch_array($result2)){
                             $userName= $row2['name'];
                         }
                         //mysqli_close($con);
			array_push($bookings, array("sno" => $row['serviceAvailabilityId'], "date" => $date, 
                            "type_service" => $serviceName, "name_user" => $userName, "booking_id" => $row['sno'],
                           "service_specification" => $availabilityName,  "amount_paid" => $row['amount_paid'],
                            "amount_due" => $row['amount_due'],"bookingStatus" => $row['booking_status'],
                            "user_email" => $user_email, "quantity" => $quantity,"serviceId" => $serviceId,"bookingDate" => $row['booking_date']));
		}while($row = mysqli_fetch_array($result));

		echo json_encode(array("bookings" => $bookings ));
	
	}
	else
	{
		echo "No Bookings";
	}


?> 