<?php
$username = $_REQUEST ['username'];
$password = $_REQUEST ['password'];
$conn=mysqli_connect('localhost','root','','yahuas');

$sql = "SELECT * FROM yahuas.yahuas_account_details where username = '$username' and password = '$password'"; 

$result = mysqli_query($conn, $sql);  
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
$count = mysqli_num_rows($result);  


if($count == 1){  
    header('Location: ../common/room.html');
}  
else{  
    echo "<h1> Login failed. Invalid username or password.</h1>";  
}     

$conn->close();
?>
