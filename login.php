<?php
include("includes/database.php");
session_start();
if(isset($_POST["submit"]))
{
    $email=$_POST['email'];
	$password=$_POST['password'];
	$usertype=$_POST['usertype'];

	
	if($usertype == "student")
	{
		$sql = "SELECT * FROM user WHERE useremail='$email'";
		if($result = mysqli_query($link, $sql))
        {
            if(mysqli_num_rows($result) == 1)
            {
				$row = mysqli_fetch_array($result);
				$hashedpassword = $row['password'];
				if(password_verify($password, $hashedpassword))
				{
					$_SESSION['userid'] = $row['userid'];
					$_SESSION['username'] = $row['username'];
					$_SESSION['email'] = $row['useremail'];
					header('Location:student_homepage.php');
				}
			}
		}
		mysqli_free_result($result);
    }
    elseif($usertype == "faculty")
	{
		$sql = "SELECT * FROM user WHERE useremail='$email'";
		if($result = mysqli_query($link, $sql))
        {
            if(mysqli_num_rows($result) == 1)
            {
				$row = mysqli_fetch_array($result);
				$hashedpassword = $row['password'];
				if(password_verify($password, $hashedpassword))
				{
					$_SESSION['userid'] = $row['userid'];
					$_SESSION['username'] = $row['username'];
					$_SESSION['email'] = $row['useremail'];
					header('Location:faculty_homepage.php');
				}
			}
		}
	}
	mysqli_close($link);
}
?>