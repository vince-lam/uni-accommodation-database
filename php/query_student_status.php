
<!DOCTYPE html>
<html>

<head>
      <link rel="stylesheet" href="../css/styles.css">
      <title>Query</title>
      <meta charset="UTF-8">
</head>

<body>

      <!-- Side navigation -->
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

      <!-- Page content -->
      <div class="main">
         <banner >YAHUAS Administrator Portal</banner>
         <br><br><br><br>
      </div>

      <div class="main" style="width: 25%; position: absolute; left:20%;">
         <h2>Report: Number of students by status </h2>

         <div class="container">
         <?php
         $conn=mysqli_connect('localhost','root','','yahuas');
         $sql="SELECT
               SUM(CASE WHEN current_status = 'waiting' THEN 1 ELSE 0 END) AS waiting_count,
               SUM(CASE WHEN current_status = 'placed' THEN 1 ELSE 0 END) AS placed_count,
               COUNT(*) AS total_students
               FROM `student`;
            ";
         if (mysqli_connect_errno())
            {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
         $rs=mysqli_query($conn,$sql);

         if (!$rs)
         {
            die("Could not get data ".mysql_error());
         }
         while($row = mysqli_fetch_array($rs))
            {
               echo ("<p>Students awaiting accommodation: ");
               echo $row['waiting_count'];
               echo ("<p>Students with placed accommodation: ");
               echo $row['placed_count'];
               echo ("<p>Total number of students: ");
               echo $row['total_students'];
               echo "<br />";
            }

         mysqli_close($conn);
         ?>
         </div>
      </div>
   
</body>
</html>

