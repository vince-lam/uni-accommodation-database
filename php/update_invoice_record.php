<?php
$invoice_id = $_REQUEST ['invoice_id'];
$invoice_paid = $_REQUEST ['invoice_paid'];
echo "$invoice_id";
echo "$invoice_paid";
$conn=mysqli_connect('localhost','root','','yahuas');
$sql="UPDATE invoice SET invoice_paid='$invoice_paid' WHERE invoice_id='$invoice_id'"; 

echo $sql;
if (mysqli_query($conn,$sql)) {
	echo "Record updated";
	}
else	{
	echo "There was an error";
}
mysqli_close($conn);    //close connection to database
?>

