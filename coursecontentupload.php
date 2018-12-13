<?php 
    include("session.php");
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
          <a class="dropdown-item" href="faculty_homepage.php">My Profile</a>
          <a class="dropdown-item" href="logout.php">Logout</a>
        </div>
      </li>
    </ul>
  </nav>


  <br/>
  <br/>

  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#contentupload">Course-content upload</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#testupload">Test-upload</a>
    </li>
  </ul>

    <br/><br/>

    <div class="tab-content">
        <div id="contentupload" class="tab-pane active">
            <div class="container">
                    <div class="col-md-3 hidden-phone"></div>
                    <div class="col-md-6" id="form-login">
                        <form class="well" action="import.php?courseid=<?php echo $courseid;?>" method="post" name="upload_excel" enctype="multipart/form-data">
                            <fieldset>
                                <legend>Import CSV/Excel file</legend>
                                <div class="control-group">
                                    <div class="control-label">
                                        <label>CSV/Excel File:</label>
                                    </div>
                                    <div class="controls form-group">
                                        <input type="file" name="file" id="file" class="input-large form-control">
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <div class="controls">
                                        <button type="submit" id="submit" name="Import" class="btn btn-success btn-flat btn-lg pull-right button-loading" data-loading-text="Loading...">Upload</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <div class="col-md-3 hidden-phone"></div>
            </div>
        </div>

        <div id="testupload" class="tab-pane">
        </div>
    </div>
  
</body>
</html>