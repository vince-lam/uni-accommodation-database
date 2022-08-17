
<!DOCTYPE html>
<html>

<head>
      <link rel="stylesheet" href="../css/styles.css">
      <title>Query</title>
      <meta charset="UTF-8">

<style>
      table, th, td {
      border: 1px solid black;
      }
</style>
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

      <div class="main" style="width: 40%; position: absolute; left:20%;">
         <h2>Report</h2>
            <p> Number of students by accommodation status </p> 

         <div class="container">
         <?php
         $conn=mysqli_connect('localhost','root','','yahuas');
         $sql="SELECT
         SUM(CASE WHEN current_status = 'waiting' THEN 1 ELSE 0 END) AS waiting_count,
         SUM(CASE WHEN current_status = 'placed' THEN 1 ELSE 0 END) AS placed_count,
         COUNT(*) AS total_students
         FROM `student`;
         ";
      $result = $conn->query($sql);

if ($result->num_rows > 0) {
   echo "<table><tr><th>Waiting</th><th>Placed</th><th>Total</th></tr>";
    // output data of each row
   while($row = $result->fetch_assoc()) {
      echo "<tr><td>" . $row["waiting_count"]. "</td><td>" . $row["placed_count"]. "</td><td>" . $row["total_students"]. "</td></tr>";
   }
   echo "</table>";
} else {
      echo "0 results";
}

$conn->close();
?>
         </div>
      </div>
   
</body>
</html>
