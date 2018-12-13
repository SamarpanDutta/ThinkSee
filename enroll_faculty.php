<?php
    include('session.php');
    include('includes/database.php');
    $userid=$_SESSION['userid'];
    $courseid=$_GET['courseid'];
    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d H:i');
    $sql="INSERT INTO coursefaculty (`courseid`, `userid`, `coursefacultydate`) VALUES ('" . $courseid . "', '" . $userid . "', '" . $date . "')";
    if($result = mysqli_query($link, $sql))
    {
        header('Location:faculty_homepage.php');
    }
?>