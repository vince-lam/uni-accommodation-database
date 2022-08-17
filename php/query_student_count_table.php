
<!DOCTYPE html>
<html>

<head>
      <link rel="stylesheet" href="../css/styles.css">
      <title>Inspection</title>
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
         <a href="room.html">Room</a>
         <a href="lease.html">Lease agreement</a>
         <a href="invoice.html">Invoice</a>
         <a class="active" href="inspection.html">Inspection</a>
         <a href="about_private.html">About</a>
      </div>

      <!-- Page content -->
      <div class="main">
         <banner >YAHUAS Administrator Portal</banner>
         <br><br><br><br>
      </div>

      <div class="main" style="width: 25%; position: absolute; left:30%;">
         <h2>Report</h2>
            <p> Number of students by status </p> 

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
