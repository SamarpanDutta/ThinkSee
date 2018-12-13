<?php
	include('login.php'); // Includes Login Script
	include('admin_login.php');
	if(isset($_POST["reg"]))
	{
		$username=$_POST['username'];
		$email=$_POST['email'];
		$password=$_POST['password'];
		if($username=="" || $email=="" || $password="")
		{
			echo "<script type= 'text/javascript'>alert('all fields are mandatory');</script>";
		}
		else
		{
			$hashedpassword = password_hash($password, PASSWORD_BCRYPT);
			$sql = "SELECT userid FROM user WHERE useremail LIKE '". $email ."'";
			if($result = mysqli_query($link, $sql))
			{
				if(mysqli_num_rows($result) == 0)
				{
					include("includes/database.php");
					$sql1 = "INSERT INTO user (`username`, `useremail`, `password`) VALUES ('" . $username . "', '" . $email . "', '" . $hashedpassword . "')";
					
					if($result1 = mysqli_query($link, $sql1))
					{
						echo "<script type= 'text/javascript'>alert('Registration Successful');</script>";
					}
					else
					{
						echo "<script type= 'text/javascript'>alert('Registration Failed');</script>";
					}
				}
				else
				{
					echo "<script type= 'text/javascript'>alert('You are already regsitered! Proceed to login');</script>";
				}
			}
			mysqli_free_result($result);
		}
	}
	if(isset($_SESSION['userid']))
	{
			header("location: student_homepage.php");
	}

	if(isset($_SESSION['adminid']))
	{
			header("location: admin_homepage.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<link rel="stylesheet" href="css/material.indigo-pink.min.css" />
	<link rel="stylesheet" href="css/google-material-icons.css" />
	<link rel="stylesheet" href="css/icon.css" />
	<link rel="stylesheet" href="css/material1.min.css" />

	<script src="js/jquery.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/material.min.js"></script>
	<script src="js/r_handler.js"></script>
	<script src="js/modal-handler.js"></script>
	<link rel="stylesheet" href="css/index.css" />
	<title>Course Portal</title>
</head>

<body>


<nav id="nav" class="navbar navbar-expand-lg fixed-top">
	<a class="navbar-brand">
		<img src="images/ThinkSee Logo.png" style="height:50px; width:50px;"></img>
		<span>ThinkSee</span>
	</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarNav">
		<ul class="navbar-nav ml-auto">
			<li class="nav-item">
				<a class="nav-link" href="#userregistration" data-toggle="modal">register</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#userloginmodal" data-toggle="modal">login</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#adminloginmodal" data-toggle="modal">admin</a>
			</li>
		</ul>
	</div>
</nav>

<div class="modal" id="userloginmodal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Login</h4>
        <button type="button" class="close" data-dismiss="modal"><i class="material-icons md -18 md-light">close</i></button>
      </div>
      <div class="modal-body login-form-div mdl-grid">
        <form action="index.php" method="post">
			<div class="mdl-cell mdl-cell--12-col cell_con">
				<i class="material-icons md-30 md-dark">email 
									&nbsp;&nbsp;
				</i>
				<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label " >
					<input class="mdl-textfield__input" type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" id="email" name="email">
					<label class="mdl-textfield__label" for="email">Your email</label>
					<span class="mdl-textfield__error">Invalid Email...!</span>
				</div>
			</div>
			<div class="mdl-cell mdl-cell--12-col cell_con">
				<i class="material-icons md-30 md-dark">lock
									&nbsp;&nbsp;
				</i>
				<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label " >
					<input class="mdl-textfield__input" type="password"  id="password" name="password">
					<label class="mdl-textfield__label" for="password">Your password</label>
				</div>
			</div>
			<div class="mdl-cell mdl-cell--12-col cell_con">
				<i class="material-icons md-30 md-dark">person
									&nbsp;&nbsp;
				</i>
				<label class = "mdl-radio mdl-js-radio" for = "student">
					<input type = "radio" id = "student" name = "usertype" 
						class = "mdl-radio__button" value="student" checked>
					<span class = "mdl-radio__label">Student</span>
				</label>
				&nbsp;&nbsp;&nbsp;
				<label class = "mdl-radio mdl-js-radio" for = "faculty">
					<input type = "radio" id = "faculty" name = "usertype" 
						class = "mdl-radio__button" value="faculty">
					<span class = "mdl-radio__label">Faculty</span>
				</label>
			</div>
			<br>
			<div class="mdl-cell mdl-cell--12-col cell_con">
				<button id="login-form-submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect " name="submit">
					Login
				</button>
		  </div>
		  <br>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="adminloginmodal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Admin Login</h4>
        <button type="button" class="close" data-dismiss="modal"S><i class="material-icons md -18 md-light">close</i></button>
      </div>
      <div class="modal-body login-form-div mdl-grid">
        <form action="index.php" method="post">
			<div class="mdl-cell mdl-cell--12-col cell_con">
				<i class="material-icons md-30 md-dark">email 
									&nbsp;&nbsp;
				</i>
				<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label " >
					<input class="mdl-textfield__input" type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" id="email" name="email">
					<label class="mdl-textfield__label" for="email">Your email</label>
					<span class="mdl-textfield__error">Invalid Email...!</span>
				</div>
			</div>
			<div class="mdl-cell mdl-cell--12-col cell_con">
				<i class="material-icons md-30 md-dark">lock
									&nbsp;&nbsp;
				</i>
				<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label " >
					<input class="mdl-textfield__input" type="password"  id="password" name="password">
					<label class="mdl-textfield__label" for="password">Your password</label>
				</div>
			</div>
			<br>
			<div class="mdl-cell mdl-cell--12-col cell_con">
				<button id="adminlogin-form-submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect " name="adminsubmit">
					Login
				</button>
		  </div>
		  <br>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="userregistration">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Register</h4>
        <button type="button" class="close" data-dismiss="modal"S><i class="material-icons md -18 md-light">close</i></button>
      </div>
      <div class="modal-body login-form-div mdl-grid">
	  <form action="index.php" method="post">
			
		<div class="mdl-cell mdl-cell--12-col cell_con">
			<i class="material-icons md-30 md-dark">person</i>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" pattern="[A-Z,a-z, ]*" type="text" id="username" name="username">
				<label class="mdl-textfield__label" for="username">Your name</label>
				<span class="mdl-textfield__error">Letters and spaces only</span>
			</div>	
		</div>
	
		<div class="mdl-cell mdl-cell--12-col cell_con">
			<i class="material-icons md-30 md-dark">email</i>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label " >
				<input class="mdl-textfield__input" type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" id="email" name="email">
				<label class="mdl-textfield__label" for="email">Your email</label>
				<span class="mdl-textfield__error">Invalid Email...!</span>
			</div>
		</div>

		<div class="mdl-cell mdl-cell--12-col cell_con">
			<i class="material-icons md-30 md-dark">lock</i>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label " >
				<input class="mdl-textfield__input" type="password"  id="passwordreg" name="password" maxlength="5">
				<label class="mdl-textfield__label" for="password">Your password</label>
			</div>
		</div>
	
		<div class="mdl-cell mdl-cell--12-col cell_con">
			<i id="pmatch" class="material-icons md-30 md-dark">highlight_off</i>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label " >
				<input class="mdl-textfield__input" type="password"  id="confirmpasswordreg" name="confirmpassword" maxlength="5">
				<label class="mdl-textfield__label" for="confirmpassword">Confirm password</label>
			</div>
		</div>
		<div class="mdl-cell mdl-cell--12-col cell_con">
			<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="reg" type="submit" name="reg">
				register
			</button>
		</div>
      </form>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid" style="display:flex; flex-direction:row; background-color:DeepSkyBlue; padding:0;">
	<div class="container" style="display:flex; flex-direction:column; flex-grow:1">
		<div class="container" style="display:flex; flex-direction:row; flex-grow:1;">
			<div class="item" style="order:1;flex-grow:0;align-self:center;">
				<img src="images/tslogo.png"></img>
			</div>
			<div class="item" style="order:2;flex-grow:1;align-self:center;">
				<h1 style="color:white;">ThinkSee</h1> 
			</div>
		</div>
		<div class="container" style="display:flex; flex-direction:row; flex-grow:1;">
			<div class="item" style="order:2;flex-grow:1;align-self:center;">
				<p style="color:white; font-size:30px; line-height:1.2;">The leading online learning center with more than thousand free available courses</p>
			</div>
		</div>
	</div>
	<div class="container" style="display:flex; flex-direction:column; padding:0;">
		<div class="item">
			<img src="images/Thinksee Banner.jpg" style="max-width:100%; max-height:100%;"></img>
		</div>
	</div>
</div>

<div class="mdl-layout ">
		<main id="course-list" class="mdl-layout__content">
            <div class="mdl-grid portfolio-max-width">
                <?php 
                    include('includes/database.php');
                    $sql = "SELECT * FROM course ORDER BY coursedate DESC";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
							while($row = mysqli_fetch_array($result)){
								$coursedescription = (string)$row['coursedescription'];
								//$coursedescription = str_pad($coursedescription, 200, " ");
								date_default_timezone_set('Asia/Kolkata');
								$currentdate = date('Y-m-d H:i:s');
								$storeddate = $row['coursedate'];
								$datedif = (strtotime($currentdate) - strtotime($storeddate)) / (60 * 60 * 24);
								$alertstring = '';
								if($datedif < 1)
								{
									$alertstring = '(New)';
								}
								echo "<div class='mdl-cell mdl-card mdl-shadow--4dp portfolio-card'>";
									echo "<div class='mdl-card__media'>";
										echo "<img class='article-image' src='' border='0' alt=''>";
									echo "</div>";
									echo "<div class='mdl-card__title'>";
										echo "<h2 class='mdl-card__title-text'>" .$row['coursename']. "</h2>";
										echo "<h5 class='mdl-card__title-text' style='color: red; font-size:18px; margin-left: 10px;'>".$alertstring."</h5>";
									echo "</div>";
									echo "<div class='mdl-card__supporting-text'>". $coursedescription . "</div>";
									echo "<div class='mdl-card__actions mdl-card--border'>";
										echo "<a class='mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect mdl-button--accent' style='color:#e83e8c; text-decoration-line:none;' href='register.php?courseid=".$row['courseid']."'>Enroll now</a>";
									echo "</div>";                 
								echo "</div>";
							}
						}
					}
					mysqli_close($link);
				?>
            </div>
            <footer class="mdl-mini-footer">
                <div class="mdl-mini-footer__left-section">
                    <div class="mdl-logo">ThinkSee</div>
                </div>
                <div class="mdl-mini-footer__right-section">
                    <ul class="mdl-mini-footer__link-list">
                        <li><a href="#">Help</a></li>
                        <li><a href="#">Privacy & Terms</a></li>
                    </ul>
                </div>
            </footer>
        </main>
</div>
</body>
</html>
