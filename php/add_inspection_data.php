<?php
$yahuas_staff_id = $_REQUEST["yahuas_staff_id"]; //get the data from the form
$inspection_date = $_REQUEST['inspection_date'];	
$room_id = $_REQUEST['room_id'];
$satisfactory_condition = $_REQUEST['satisfactory_condition'];	
$inspection_comments = $_REQUEST['inspection_comments'];	

$conn=mysqli_connect('localhost','root','','yahuas');
$sql="INSERT INTO room (yahuas_staff_id, inspection_date, room_id, satisfactory_condition, inspection_comments) VALUES ('$yahuas_staff_id','$inspection_date','$room_id','$satisfactory_condition','$inspection_comments')";
if (mysqli_connect_errno())
   {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }
if (mysqli_query($conn,$sql)) {
	echo "Record added";
	}
mysqli_close($conn);				//close connection to database
?> 