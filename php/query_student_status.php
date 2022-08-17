
<!DOCTYPE html>
<html>

<head>
      <link rel="stylesheet" href="../css/styles.css">
      <title>Inspection</title>
      <meta charset="UTF-8">
</head>

<body>

      <!-- Side navigation -->
      <div class="sidenav">
         <a href="../common/room.html">Room</a>
         <a href="../common/lease.html">Lease agreement</a>
         <a href="../common/invoice.html">Invoice</a>
         <a href="../common/inspection.html">Inspection</a>
         <a href="../common/about_private.html">About</a>
      </div>

      <!-- Page content -->
      <div class="main">
         <banner >YAHUAS Administrator Portal</banner>
         <br><br><br><br>
      </div>

      <div class="main" style="width: 25%; position: absolute; left:30%;">
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

