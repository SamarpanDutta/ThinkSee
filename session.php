<?php
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
include("includes\database.php");
session_start();// Starting Session
// Storing Session
$userid_check=$_SESSION['userid'];
$useremail_check=$_SESSION['email'];
$username_check=$_SESSION['username'];
// SQL Query To Fetch Complete Information Of User
$sql= "SELECT * FROM user WHERE userid='$userid_check' AND username='$username_check' AND useremail='$useremail_check'";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);
$login_session_userid = $row['userid'];
mysqli_free_result($result);
if(!isset($login_session_userid))
{
    mysqli_close($link); // Closing Connection
    header('Location: index.php'); // Redirecting To Home Page
}
?>