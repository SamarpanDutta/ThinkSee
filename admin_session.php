<?php
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
include("includes\database.php");
session_start();// Starting Session
// Storing Session
$adminid_check=$_SESSION['adminid'];
$email_check=$_SESSION['email'];
$adminname_check=$_SESSION['adminname'];
// SQL Query To Fetch Complete Information Of User
$sql= "SELECT * FROM `admin` WHERE adminid='$adminid_check' AND adminname='$adminname_check' AND email='$email_check'";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);
$login_session_adminid = $row['adminid'];
mysqli_free_result($result);
if(!isset($login_session_adminid))
{
    mysqli_close($link); // Closing Connection
    header('Location: index.php'); // Redirecting To Home Page
}
?>