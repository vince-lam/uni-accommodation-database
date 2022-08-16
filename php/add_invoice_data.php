<?php
$lease_id = $_REQUEST["lease_id"]; //get the data from the form
$building_id = $_REQUEST['invoice_date'];	
$year_semester = $_REQUEST['year_semester'];
$payment_due = $_REQUEST['payment_due'];	
$invoice_paid = $_REQUEST['invoice_paid'];	
$payment_method = $_REQUEST['payment_method'];
$reminder_date = $_REQUEST['reminder_date'];	
$reminder_date_2 = $_REQUEST['reminder_date_2'];	

$conn=mysqli_connect('localhost','root','','yahuas');
$sql="INSERT INTO room (lease_id, invoice_date, year_semester, payment_due, invoice_paid, payment_method, reminder_date, reminder_date_2) VALUES ('$lease_id','$invoice_date','$year_semester','$payment_due','$invoice_paid', '$payment_method', '$reminder_date', '$reminder_date_2')";
if (mysqli_connect_errno())
   {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }
if (mysqli_query($conn,$sql)) {
	echo "Record added";
	}
mysqli_close($conn);				//close connection to database
?> 