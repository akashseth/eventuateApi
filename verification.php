<?php

	#PHP script for user verification

	require "init.php";

	$EmailId=$_POST['Email'];
	$Passcode=$_POST['Passcode'];


	# extracting the user info for verification
	$query = "select * from `eventuate`.`users` where `users`.`email_id` like '$EmailId';";
	$result=mysqli_query($con, $query);

	$row=mysqli_fetch_array($result);

	$userId = $row['id'];
        $query2 = "SELECT fullName,mobNo,address FROM profile_services where profile_services.userId = '$userId';";
        $result2 = mysqli_query($con, $query2);
        $row2 = mysqli_fetch_array($result2);
        $fullName = $row2['fullName'];
        $address = $row2['address'];
        $mblNo = $row2['mobNo'];
        
        $query2 = "select serviceId FROM servicesproviding where serviceProviderId = '$userId' ;";
        $result2 = mysqli_query($con, $query2);
        $servicesId=array();
        $i=0;
        
        while($row2=mysqli_fetch_array($result2)) {
  
            $servicesId[$i] = $row2['serviceId'];
            $i++;
        }
	if($row['EMAIL_ID'] != "")
		echo json_encode(array("EmailId" => $row['EMAIL_ID'], "UserType" => $row['USER_TYPE'], 
                    "PassCode" => $row['PASSCODE'], "userId" => $row['id'],"servicesId" => $servicesId,
                   "fullName" => $fullName,"address" => $address,"mobileNo" => $mblNo));
	
?>

	