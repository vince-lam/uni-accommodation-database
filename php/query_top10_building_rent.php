
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
         <h2>Report: Top 10 buildings by monthly rental income</h2>

         <div class="container">
         <?php
         $conn=mysqli_connect('localhost','root','','yahuas');
         $sql="WITH all_rooms_CTE(room_id, building_id, building_name, halls_id, halls_name, monthly_rent, lease_id) AS (
            SELECT 
                r.room_id
                ,r.building_id
                ,b.building_name
                ,b.halls_id
                ,h.halls_of_residence_name
                ,r.monthly_rent
                ,l.lease_id
            FROM room r
            LEFT JOIN building b ON r.building_id = b.building_id
            LEFT JOIN halls h ON b.halls_id = h.halls_id
            LEFT JOIN lease_agreement l ON r.room_id = l.room_id
        )
            SELECT 
                halls_name
                ,building_name
                ,COUNT(*) count_of_rooms_rented
                ,ROUND(SUM(monthly_rent), 2) monthly_rent
                ,RANK() OVER (ORDER BY ROUND(SUM(monthly_rent), 2) DESC) rank_by_monthly_rent_generated
            FROM all_rooms_CTE
            WHERE lease_id IS NOT NULL
            GROUP BY halls_name, building_name
            ORDER BY 4 DESC
            LIMIT 10
         ";
      $result = $conn->query($sql);

if ($result->num_rows > 0) {
   echo "<table><tr><th>Halls</th><th>Building</th><th>Rooms rented</th><th>Total monthly rent (£)</th><th>Rank</th></tr>";
    // output data of each row
   while($row = $result->fetch_assoc()) {
      echo "<tr><td>" . $row["halls_name"]. "</td><td>" . $row["building_name"]. "</td><td>" . $row["count_of_rooms_rented"]. "</td><td>" . $row["monthly_rent"]. "</td><td>" . $row["rank_by_monthly_rent_generated"]. "</td></tr>";
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
