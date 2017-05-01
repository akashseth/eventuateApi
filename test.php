<?php

	#PHP script for extracting the expenditure details of the organizer

	require "init.php";

$table_name='test';

$query = "select * from `eventuate`.`$table_name`";
	$result = mysqli_query($con, $query);

$size=mysqli_num_rows($result);
echo $size;


?> 