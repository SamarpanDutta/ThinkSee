<?php
include('session.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/material.indigo-pink.min.css"/>
  <link rel="stylesheet" href="css/student_homepage.css" />
  <script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/material.min.js"></script>
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
          <a class="dropdown-item" href="faculty_homepage.php">Faculty mode</a>
          <a class="dropdown-item" href="change_password.php">change password</a>
          <a class="dropdown-item" href="logout.php">Logout</a>
        </div>
      </li>
    </ul>
  </nav>


  <br/>
  <br/>

  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#dashboard">Dashboard</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#other_courses">Other Courses</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#myprofile">My Profile</a>
    </li>
  </ul>
  
  <div class="tab-content">

    <div id="dashboard" class="tab-pane active">
      <div class="mdl-grid portfolio-max-width">
          <?php 
              include('includes/database.php');
              $sql = "SELECT * FROM coursestudent WHERE userid = " . $_SESSION['userid'] . "";
              if($result = mysqli_query($link, $sql))
              {
                  if(mysqli_num_rows($result) > 0)
                  {
                      while($row = mysqli_fetch_array($result))
                      {
                          $sql1 = "SELECT * FROM course WHERE courseid = " . $row['courseid'] . "";
                          if($result1 = mysqli_query($link, $sql1))
                          {
                              if(mysqli_num_rows($result1) == 1)
                              {
                                  $row1 = mysqli_fetch_array($result1);
                                  $coursedescription = (string)$row1['coursedescription'];
                                  echo "<div class='mdl-cell mdl-card mdl-shadow--4dp portfolio-card'>";
                                      echo "<div class='mdl-card__media'>";
                                          echo "<img class='article-image' src='' border='0' alt=''>";
                                      echo "</div>";
                                      echo "<div class='mdl-card__title'>";
                                          echo "<h2 class='mdl-card__title-text'>". $row1['coursename'] ."</h2>";
                                      echo "</div>";
                                      echo "<div class='mdl-card__supporting-text'>". $coursedescription . "</div>";
                                      echo "<div class='mdl-card__actions mdl-card--border'><!--color:#e83e8c-->";
                                          echo "<a class='mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect mdl-button--accent' style='color:#e83e8c; text-decoration-line:none;' href='courseview.php?courseid=". $row['courseid'] ."'>Go to Course</a>";
                                      echo "</div>";                 
                                  echo "</div>";
                              }
                              mysqli_free_result($result1);
                          }
                      }
                      mysqli_free_result($result);
                  }
              }
              mysqli_close($link);
          ?>
      </div>
    </div>

    <div id="other_courses" class="tab-pane">
      <div class="mdl-grid portfolio-max-width">
          <?php 
                include('includes/database.php');
                $userid=$_SESSION['userid'];
                $sql = "SELECT `courseid` from `course` where `courseid` not in( SELECT `courseid` from `coursestudent` where `userid`='$userid' UNION SELECT `courseid` from `coursefaculty` where `userid`='$userid')";
                if($result = mysqli_query($link, $sql))
                {
                    if(mysqli_num_rows($result) > 0)
                    {
                        while($row = mysqli_fetch_array($result))
                        {
                            $sql1 = "SELECT * FROM course WHERE courseid = " . $row['courseid'] . "";
                            if($result1 = mysqli_query($link, $sql1))
                            {
                                if(mysqli_num_rows($result1) == 1)
                                {
                                    $row1 = mysqli_fetch_array($result1);
                                    $coursedescription = (string)$row1['coursedescription'];
                                    echo "<div class='mdl-cell mdl-card mdl-shadow--4dp portfolio-card'>";
                                        echo "<div class='mdl-card__media'>";
                                            echo "<img class='article-image' src='' border='0' alt=''>";
                                        echo "</div>";
                                        echo "<div class='mdl-card__title'>";
                                            echo "<h2 class='mdl-card__title-text'>". $row1['coursename'] ."</h2>";
                                        echo "</div>";
                                        echo "<div class='mdl-card__supporting-text'>". $coursedescription . "</div>";
                                        echo "<div class='mdl-card__actions mdl-card--border'><!--color:#e83e8c-->";
                                            echo "<a class='mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect mdl-button--accent' style='color:#e83e8c; text-decoration-line:none;' href='enroll_student.php?courseid=". $row['courseid'] ."'>Enroll Now</a>";
                                        echo "</div>";                 
                                    echo "</div>";
                                }
                                mysqli_free_result($result1);
                            }
                        }
                        mysqli_free_result($result);
                    }
                }
                mysqli_close($link);
          ?>
      </div>
    </div>
  </div>
  
</body>
</html>
      