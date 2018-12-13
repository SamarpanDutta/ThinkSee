<?php 
include('includes/database.php');

$cfid = $_POST['id'];

// Delete record
$query = "UPDATE coursefaculty SET approval = 1 WHERE cfid = " . $cfid. "";
mysqli_query($con,$query);

echo 1;

?>