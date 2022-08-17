
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

      <div class="main" style="width: 50%; position: absolute; left:15%;">
         <h2>Report: Top 10 buildings with most rooms due an inspection</h2>

         <div class="container">
         <?php
         $conn=mysqli_connect('localhost','root','','yahuas');
         $sql="SELECT 
                  h.halls_of_residence_name
               ,COUNT(r.room_id) rooms_to_be_inspected
               FROM room r
               LEFT JOIN building b USING (building_id)
               LEFT JOIN halls h USING (halls_id)
               LEFT JOIN inspection i USING (room_id)
               WHERE inspection_id IS NULL
               OR satisfactory_condition != 1
               OR inspection_date < DATE_SUB(CURRENT_DATE(), INTERVAL 1 YEAR)
               GROUP BY h.halls_of_residence_name
               ORDER BY 2 DESC
               LIMIT 10
         ";
      $result = $conn->query($sql);

if ($result->num_rows > 0) {
   echo "<table><tr><th>Halls</th><th>rooms_to_be_inspected</th></tr>";
    // output data of each row
   while($row = $result->fetch_assoc()) {
      echo "<tr><td>" . $row["halls_of_residence_name"]. "</td><td>" . $row["rooms_to_be_inspected"]. "</td></tr>";
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
