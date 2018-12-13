<?php
include("includes/database.php");
if(isset($_POST["adminsubmit"]))
{
    $email=$_POST['email'];
    $password=$_POST['password'];
    
    if($email==""||$password=="")
    {
        echo "<script type= 'text/javascript'>alert('all fields are mandatory');</script>";
    }
    else
    {
        $sql = "SELECT * FROM `admin` WHERE email='$email'";
        if($result = mysqli_query($link, $sql))
        {
            if(mysqli_num_rows($result) == 1)
            {
                if($row = mysqli_fetch_array($result))
                {
                    $_SESSION['adminid'] = $row['adminid'];
                    $_SESSION['adminname'] = $row['adminname'];
                    $_SESSION['email'] = $row['email'];
                    header('Location:admin_homepage.php');
                }
            }
        }
    }
  
	mysqli_close($link);
}
?>