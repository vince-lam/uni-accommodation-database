<?php
$student_id = $_REQUEST["student_id"]; //get the data from the form
$lease_duration = $_REQUEST['lease_duration'];	
$start_date = $_REQUEST['start_date'];
$end_date = $_REQUEST['end_date'];	
$room_id = $_REQUEST['room_id'];	

$conn=mysqli_connect('localhost','root','','yahuas');
$sql="INSERT INTO room (student_id, lease_duration, start_date, end_date, room_id) VALUES ('$student_id','$lease_duration','$start_date','$end_date','$room_id')";
if (mysqli_connect_errno())
   {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }
if (mysqli_query($conn,$sql)) {
	echo "Record added";
	}
mysqli_close($conn);				//close connection to database
?> 