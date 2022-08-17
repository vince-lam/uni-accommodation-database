<?php
$next_of_kin_id = $_REQUEST ['next_of_kin_id'];
$conn=mysqli_connect('localhost','root','','yahuas');

if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
// sql to delete a record
$sql = "DELETE FROM next_of_kin WHERE next_of_kin_id = '$next_of_kin_id'";

if ($conn->query($sql) === TRUE) {
echo "Record deleted successfully";
} else {
echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>