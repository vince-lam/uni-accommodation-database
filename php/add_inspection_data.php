
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

        <<?php
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

    </div>
</body>
</html>



