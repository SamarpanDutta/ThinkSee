<?php
include('admin_session.php');
if(isset($_POST["submit"]))
{
  $coursename=$_POST['coursename'];
  $coursedescription=$_POST['coursedescription'];
  date_default_timezone_set('Asia/Kolkata');
  $coursedate = date('Y-m-d H:i');
  include("includes/database.php");
  $sql = "INSERT INTO course (coursename, coursedescription, coursedate) VALUES ('" . $coursename . "', '" . $coursedescription . "', '" . $coursedate . "')";
  if(mysqli_query($link, $sql)){
      echo "<script type= 'text/javascript'>alert('New record created successfully');</script>";
  } else{
      echo "<script type= 'text/javascript'>alert('No data inserted');</script>";
  }
  mysqli_close($link);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/material.indigo-pink.min.css"/>
  <link rel="stylesheet" href="css/icon.css"/>
  <link rel="stylesheet" href="css/admin_homepage.css" />
  <script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/material.min.js"></script>
  <script src="js/admin_approval.js"></script>
  <script src="js/admin_rejection.js"></script>
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
            $sql = "SELECT * FROM `admin` WHERE adminid = " . $_SESSION['adminid'] . "";
            if($result = mysqli_query($link, $sql))
            {
                if(mysqli_num_rows($result) == 1)
                {
                    $row = mysqli_fetch_array($result);
                    echo $row['adminname']." ( WebAdmin )";
                }
            }
            mysqli_close($link);
          ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="logout.php">Logout</a>
        </div>
      </li>
    </ul>
  </nav>


  <br/>
  <br/>

  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#create_course">Create Course</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#pending_approval">Pending Approval</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#myprofile">My Profile</a>
    </li>
  </ul>
  <br/><br/>
  <div class="tab-content">

    <div id="create_course" class="tab-pane active">
      <div class="container">
        <form action="admin_homepage.php" method="post">
          <div class="form-group">
              <label for="coursename">Course Name:</label>
              <input type="text" class="form-control" id="coursename" placeholder="Enter course name" name="coursename">
          </div>
          <br/><br/>
          <div class="form-group">
              <label for="coursedescription">Course description:</label>
              <textarea class="form-control" rows="5" maxlength="200" id="coursedescription" placeholder="Short description within 200 characters" name="coursedescription"></textarea>
          </div>
          <input type="submit" class="btn btn-primary" value=" Submit " name="submit"/>
        </form>
      </div>
    </div>

    <div id="pending_approval" class="tab-pane">
        <div class="container-fluid">
            <table class="table">
                <thead id="a_thead">
                    <tr>
                        <th>Course name</th>
                        <th>User email</th>
                        <th>Approve</th>
                        <th>Reject</th>
                    </tr>
                </thead>
                <tbody id="a_tbody">
                <?php 
                    include('includes/database.php');
                    $query = "SELECT * FROM coursefaculty WHERE approval = 0";
                    $result = mysqli_query($link,$query);
                    while($row = mysqli_fetch_array($result) )
                    {
                        $cfid = $row['cfid'];
                        $courseid = $row['courseid'];
                        $userid = $row['userid'];
                        $useremail = '';
                        $coursename = '';
                        $sql1 = "SELECT coursename FROM course WHERE courseid = " . $courseid . "";
                        $sql2 = "SELECT useremail FROM user WHERE userid = " . $userid . "";
                        $result1 = mysqli_query($link,$sql1);
                        $result2 = mysqli_query($link,$sql2);
                        while($row1 = mysqli_fetch_array($result1))
                        {
                            $coursename = $row1['coursename'];
                        }
                        while($row2 = mysqli_fetch_array($result2))
                        {
                            $useremail = $row2['useremail'];
                        }
                ?>
                        <tr>
                            <td ><?php echo $coursename; ?></td>
                            <td><?php echo $useremail; ?></td>
                            <td>
                              <button class='mdl-button mdl-js-button mdl-button--icon approval' id='approval_<?php echo $cfid; ?>'>
                                <i class="material-icons md-30 md-dark">check_circle</i>
                              </button>
                            </td>
                            <td>
                              <button class='mdl-button mdl-js-button mdl-button--icon rejection' id='rejection_<?php echo $cfid; ?>'>
                                <i class="material-icons md-30 md-dark">highlight_off</i>
                              </button>
                            </td>
                        </tr>
                <?php
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>

    <div id="myprofile" class="tab-pane">
      <table class="table table-striped" style="font-size:20px">
        <thead>
          <tr>
            <th>Name</th>
            <th><?php echo $_SESSION['adminname']; ?></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Email</td>
            <td><?php echo $_SESSION['email']; ?></td>
          </tr>
          <tr>
            <td>Usertype</td>
            <td>admin</td>
          </tr>
        </tbody>
      </table>
      <br/>
      <br/>

      <a id="change-password" role="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect " href="change_password.php">
        Change password
      </a>

    </div>

  </div>
  
</body>
</html>
      