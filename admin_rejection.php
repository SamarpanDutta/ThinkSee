<?php 
include('includes/database.php');

$cfid = $_POST['id'];

// Delete record
$query = "DELETE FROM coursefaculty WHERE cfid = " . $cfid . "";
mysqli_query($link,$query);
mysqli_close($link);

echo 1;

?>