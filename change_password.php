<?php
include('session.php');
include('includes/database.php');
$error="";
if(isset($_POST['change_password']))
{
    $userid=$_SESSION['userid'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $re_password = $_POST['re_password'];
    if(empty($old_password) || empty($new_password) || empty($re_password))
    {
        $error="all fields are mandatory";
    }
    else
    {
        $hashedpassword_m = password_hash($new_password, PASSWORD_BCRYPT);
        $sql="SELECT * FROM user WHERE userid='$userid'"; 
        if($result = mysqli_query($link, $sql))
        {
            if(mysqli_num_rows($result) == 1)
            {
                $row = mysqli_fetch_array($result);
                $hashedpassword=$row['password'];
                if(password_verify($old_password, $hashedpassword))
                {
                    $sql1="UPDATE user SET password = '$hashedpassword_m' WHERE userid = '$userid'";
                    if($result1 = mysqli_query($link, $sql1))
                    {
                        header('Location:student_homepage.php');
                    }
                    else
                    {
                        $error="password updation unsuccessful";
                    }
                }
                else
                {
                    $error="enter correct old password";
                }
            }
            mysqli_free_result($result);
        }  
        else
        {
            $error="unknown error occured";
        }     
    }
}
mysqli_close($link);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/material.indigo-pink.min.css"/>
  <link rel="stylesheet" href="css/google-material-icons.css" />
  <link rel="stylesheet" href="css/change_password.css" />
  <script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/material.min.js"></script>
  <script src="js/cp_handler.js"></script>
</head>

<body>
<nav id="nav" class="navbar navbar-expand-lg fixed-top">
	<a class="navbar-brand">
		<img src="images/ThinkSee Logo.png" style="height:50px; width:50px;"></img>
		<span>ThinkSee</span>
	</a>
	<ul class="nav navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php 
            include('includes/database.php');
            $sql = "SELECT * FROM user WHERE userid = " . $_SESSION['userid'] . "";
            if($result = mysqli_query($link, $sql))
            {
                if(mysqli_num_rows($result) == 1)
                {
                    $row = mysqli_fetch_array($result);
                    echo $row['username'];
                }
            }
            mysqli_close($link);
          ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#myprofile">My Profile</a>
          <a class="dropdown-item" href="logout.php">Logout</a>
        </div>
      </li>
    </ul>
</nav>

<div class="mdl-grid center-items">
    <form action="change_password.php" method="post">
        <div class="mdl-cell mdl-cell--12-col cell_con">
            <i class="material-icons md-30 md-dark">lock</i>
            &nbsp;&nbsp;
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label " >
                <input class="mdl-textfield__input" type="password"  id="old_password" name="old_password">
                <label class="mdl-textfield__label" for="password">Old password</label>
            </div>
        </div>
        
        <div class="mdl-cell mdl-cell--12-col cell_con">
            <i class="material-icons md-30 md-dark">lock</i>
            &nbsp;&nbsp;
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label " >
                <input class="mdl-textfield__input" type="password"  id="new_password" name="new_password">
                <label class="mdl-textfield__label" for="password">New password</label>
            </div>
        </div>
        <div class="mdl-cell mdl-cell--12-col cell_con">
            <i id="pmatch" class="material-icons md-30 md-dark">highlight_off</i>
            &nbsp;&nbsp;
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label " >
                <input class="mdl-textfield__input" type="password"  id="re_password" name="re_password">
                <label class="mdl-textfield__label" for="password"> Retype password</label>
            </div>
        </div>
        <br/>
        <div class="mdl-cell mdl-cell--12-col cell_con">
            <button id="change_password" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect " name="change_password" type="submit">
                Change Password
                <span class="mdl-button__ripple-container">
                    <span class="mdl-ripple"></span>
                </span>
            </button>
        </div>
        <div class="mdl-cell mdl-cell--12-col cell_con">
            <span id="status"><?php echo $error;?></span>
        </div>
        <br/>
    </form>
</div>
</body>
</html>
