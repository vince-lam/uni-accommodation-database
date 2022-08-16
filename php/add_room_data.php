<?php
$room_type_id = $_REQUEST["room_type_id"]; //get the data from the form
$building_id = $_REQUEST['building_id'];	
$room_number = $_REQUEST['room_number'];
$monthly_rent = $_REQUEST['monthly_rent'];	

$conn=mysqli_connect('localhost','root','','yahuas');
$sql="INSERT INTO room (room_type_id, building_id, room_number, monthly_rent) VALUES ('$room_type_id','$building_id','$room_number','$monthly_rent')";
if (mysqli_connect_errno())
   {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }
if (mysqli_query($conn,$sql)) {
	echo "Record added";
	}
mysqli_close($conn);				//close connection to database
?> 



