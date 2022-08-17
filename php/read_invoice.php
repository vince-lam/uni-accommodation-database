<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../css/styles.css">
    <title>About</title>
    <meta charset="UTF-8">
</head>
    
<body>
    <style> </style> 
    <!-- <img src="img/logo_navy_cropped.png" class="left"; z-index: 1; position: absolute; left: 0px; top: 0px;"> -->

    <div class="sidenav">
         <a href="../common/room.html">Add room</a>
        <a href="../common/lease.html">Add lease agreement</a>
        <a href="../common/invoice.html">Add invoice</a>
        <a href="../common/read_invoice.html">Read invoice</a>
        <a href="../common/update_invoice_record.html">Update invoice</a>
        <a href="../common/inspection.html">Add inspection</a>
        <a href="../common/delete_next_of_kin.html">Delete next of kin record</a>
        <a href="query_student_count_table.php">Report: student status count</a>
        <a href="query_buildings_due_inspection.php">Report: buildings due inspection</a>
        <a href="query_top10_building_rent.php">Report: Top buildings by total monthly rent</a>   
        <a href="../common/about_private.html">About</a>

    </div>  
    
    <div class="main">
        <banner >YAHUAS Administrator Portal</banner>
        <br><br><br><br>


         
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

    </div>
</body>
</html>






