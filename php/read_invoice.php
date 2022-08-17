<html>
<body>
<?php
$invoice_id = $_POST['invoice_id'];	//get the data from the form
$conn=mysqli_connect('localhost','root','','yahuas');
$sql="SELECT * FROM invoice WHERE invoice_id = '$invoice_id'"; 
if (mysqli_connect_errno())
   {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }
$rs=mysqli_query($conn,$sql);
if (!$rs)
{
	die("Could not get data ");
}
if ($row=mysqli_fetch_array($rs)) {		//if there is an output
$invoice_id=$row['invoice_id'];
$lease_id=$row['lease_id'];
$invoice_date=$row['invoice_date'];
$year_semester=$row['year_semester'];
$payment_due=$row['payment_due'];
$invoice_paid=$row['invoice_paid'];
$payment_method=$row['payment_method'];
$reminder_date=$row['reminder_date'];
$reminder_date_2=$row['reminder_date_2'];


echo ("<table>");	
echo ("<tr><td>Invoice ID:</td><td>".$invoice_id. "</td></tr>");
echo ("<tr><td>Lease ID:</td><td>".$lease_id."</td></tr>");
echo ("<tr><td>Invoice date.:</td><td>".$invoice_date."</td></tr>");
echo ("<tr><td>Year semester:</td><td>".$year_semester."</td></tr>");
echo ("<tr><td>Payment due date:</td><td>".$payment_due."</td></tr>");
echo ("<tr><td>Invoice:</td><td>".$invoice_paid."</td></tr>");
echo ("<tr><td>Payment method:</td><td>".$payment_method. "</td></tr>");
echo ("<tr><td>First reminder date:</td><td>".$reminder_date."</td></tr>");
echo ("<tr><td>Second reminder date:</td><td>".$reminder_date_2."</td></tr>");
echo ("</table>"); 
}
else {							//if there is no output
	echo ("<p>Invoice not found</p>");
	}
mysqli_close($conn);				//close connection to database
?>
</body>
</html>
