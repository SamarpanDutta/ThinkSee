<?php 
    include('session.php');
    $courseid = intval($_GET['courseid']);
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
          <a class="dropdown-item" href="#myprofile">My Profile</a>
          <a class="dropdown-item" href="logout.php">Logout</a>
        </div>
      </li>
    </ul>
</nav>
<br/>
<br/>

<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#about_course">About Course</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#content">Chapterwise Content</a>
    </li>
</ul>

<br/>
<br/>

<div class="tab-content">
    <div id="about_course" class="tab-pane active">
        <div class="container">
        <p style="font-size:20px;">
            <?php 
            include('includes/database.php');
            $sql = "SELECT * FROM course WHERE courseid = " . $courseid . "";
            if($result = mysqli_query($link, $sql))
            {
                if(mysqli_num_rows($result)==1)
                {
                    $row = mysqli_fetch_array($result);
                    echo $row['coursedescription'];
                }
            }
            ?>
        </p>
        </div>
    </div>

    <div id="content" class="tab-pane">
    <div class="container">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Chapter name</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                include('includes/database.php');
                $sql = "SELECT * FROM coursecontent WHERE courseid = " . $courseid . "";
                if($result = mysqli_query($link, $sql))
                {
                    if(mysqli_num_rows($result) > 0)
                    {
                        while($row = mysqli_fetch_array($result))
                        {
                            echo "<tr>";
                            echo "<td><a href=' ".$row['url']." ' target='_blank'>" . $row['contentname'] . "</a></td>";
                            echo "</tr>";
                        }
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    </div>
</div>    
 
</body>
</html>