<?php
//if (password_verify($password, $hashedPassword)) {
    // Correct password
// }
$courseid = intval($_GET['courseid']);
if(isset($_POST["submit"]))
{
    $username=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $confirmpassword=$_POST['confirmpassword'];
    $usertype=$_POST['usertype'];
    date_default_timezone_set('Asia/Kolkata');
    $courseuserdate = date('Y-m-d H:i');
    if($password == $confirmpassword)
    {
        $hashedpassword = password_hash($password, PASSWORD_BCRYPT);
        include("includes/database.php");
        $userid = NULL;
        $sql = "SELECT userid FROM user WHERE useremail LIKE '". $email ."'";
        if($result = mysqli_query($link, $sql))
        {
            if(mysqli_num_rows($result) == 0)
            {
                $sql1 = "INSERT INTO user (`username`, `useremail`, `password`) VALUES ('" . $username . "', '" . $email . "', '" . $hashedpassword . "')";
                if(mysqli_query($link, $sql1))
                {
                    if($result1 = mysqli_query($link, $sql))
                    {
                        $fieldinfo=mysqli_fetch_array($result1);
                        $userid = (int) $fieldinfo[0];
                        if($usertype=="student"){
                            $sql2 = "INSERT INTO coursestudent (`courseid`, `userid`, `coursestudentdate`) VALUES (" . $courseid . ", " . $userid . ", '" . $courseuserdate . "')";
                            if(mysqli_query($link, $sql2))
                            {
                                echo "<script type= 'text/javascript'>alert('You are registered as student to this course');</script>";
                            }
                        }
                        if($usertype=="faculty"){
                            $sql2 = "INSERT INTO coursefaculty (`courseid`, `userid`, `coursefacultydate`) VALUES (" . $courseid . ", " . $userid . ", '" . $courseuserdate . "')";
                            if(mysqli_query($link, $sql2))
                            {
                                echo "<script type= 'text/javascript'>alert('You are registered as faculty to this course and wait for admin approval');</script>";
                            }
                        }
                    }
                } 
            }
            else
            {
                $row=mysqli_fetch_array($result);
                $userid=(int)$row[0];
                $sql4 = "SELECT * FROM coursestudent WHERE courseid = ". $courseid . " AND userid = ". $userid . "";
                $sql5 = "SELECT approval FROM coursefaculty WHERE courseid = ". $courseid . " AND userid = ". $userid . "";
                $result4 = mysqli_query($link, $sql4);
                $result5 = mysqli_query($link, $sql5);
                if($result4  && $result5)
                {
                    if(mysqli_num_rows($result4) == 0 && mysqli_num_rows($result5) == 0)
                    {
                        if($usertype=="student"){
                            $sql6 = "INSERT INTO coursestudent VALUES (" . $courseid . ", " . $userid . ", '" . $courseuserdate . "')";
                            if(mysqli_query($link, $sql6))
                            {
                                echo "<script type= 'text/javascript'>alert('You are registered as student to this course');</script>";
                            }
                        }
                        if($usertype=="faculty"){
                            $sql7 = "INSERT INTO coursefaculty (`courseid`, `userid`, `coursefacultydate`) VALUES (" . $courseid . ", " . $userid . ", '" . $courseuserdate . "')";
                            if(mysqli_query($link, $sql7))
                            {
                                echo "<script type= 'text/javascript'>alert('You are registered as faculty to this course and wait for admin approval');</script>";
                            }
                        }
                    }
                    else
                    {
                        if(mysqli_num_rows($result4) > 0)
                        {
                            echo "<script type= 'text/javascript'>alert('You have been already registered as student to this course');</script>";
                        }
                        if(mysqli_num_rows($result5) > 0)
                        {
                            $fieldinfo=mysqli_fetch_array($result5);
                            $approval=(int)$fieldinfo[0];
                            if($approval == 0)
                            {
                                echo "<script type= 'text/javascript'>alert('You have been registered as faculty to this course and waiting for admin approval');</script>";
                            }
                            if($approval == 1)
                            {
                                echo "<script type= 'text/javascript'>alert('You have been registered as faculty to this course');</script>";
                            }
                        }
                    }
                }
            }
        }
    }
    else
    {
        echo "<script type='text/javascript'>alert('There is a mismatch between password and confirm password')</script>";
    }
    mysqli_close($link);
    echo "<script> location.href='index.php'; </script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="A portfolio template that uses Material Design Lite.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>Registration form</title>
    <link rel="stylesheet" href="css/google-font.css" />
    <link rel="stylesheet" href="css/material.min.css" />
    <link rel="stylesheet" href="css/mdstyles.css" />
    <link rel="stylesheet" href="css/google-material-icons.css" />
    <script src="js/material.min.js"></script>
</head>

<body>
    <div class="mdl-layout">
        <main class="mdl-layout__content">
            <div class="mdl-grid portfolio-max-width portfolio-contact">
                <div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--4dp">
                    <div class="mdl-card__title">
                        <h2 class="mdl-card__title-text" style="text-align:center;">User Registration</h2>
                    </div>
                    <div class="mdl-card__media" style="background-color:rgb(63,81,181);">
                        <img class="article-image" src="" border="0" alt="">
                    </div>
                    <div class="mdl-card__supporting-text">
                        <form action="register.php?courseid=<?php echo $courseid ?>" method="post">
                            <table>
                                <tr>
                                    <td>
                                        <div class="mdl-cell mdl-cell--1-col cell_con">
                                            <i class="material-icons md-30 md-dark">person</i>
                                        </div>
                                    </td>
                                    <td style="width:100%;">
                                        <div class="mdl-cell mdl-cell--12-col cell_con">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                                <input class="mdl-textfield__input" pattern="[A-Z,a-z, ]*" type="text" id="username" name="username">
                                                <label class="mdl-textfield__label" for="username">Your name</label>
                                                <span class="mdl-textfield__error">Letters and spaces only</span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="mdl-cell mdl-cell--1-col cell_con">
                                            <i class="material-icons md-30 md-dark">email</i>
                                        </div>
                                    </td>
                                    <td style="width:100%;">
                                        <div class="mdl-cell mdl-cell--12-col cell_con">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label " >
                                                <input class="mdl-textfield__input" type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" id="email" name="email">
                                                <label class="mdl-textfield__label" for="email">Your email</label>
                                                <span class="mdl-textfield__error">Invalid Email...!</span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="mdl-cell mdl-cell--1-col cell_con">
                                            <i class="material-icons md-30 md-dark">lock</i>
                                        </div>
                                    </td>
                                    <td style="width:100%;">
                                        <div class="mdl-cell mdl-cell--12-col cell_con">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label " >
                                                <input class="mdl-textfield__input" type="password"  id="password" name="password" maxlength="5">
					                            <label class="mdl-textfield__label" for="password">Your password</label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="mdl-cell mdl-cell--1-col cell_con">
                                            <i class="material-icons md-30 md-dark">lock</i>
                                        </div>
                                    </td>
                                    <td style="width:100%;">
                                        <div class="mdl-cell mdl-cell--12-col cell_con">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label " >
                                                <input class="mdl-textfield__input" type="password"  id="confirmpassword" name="confirmpassword" maxlength="5">
					                            <label class="mdl-textfield__label" for="confirmpassword">Confirm password</label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="mdl-cell mdl-cell--1-col cell_con">
                                            <i class="material-icons md-30 md-dark">person</i>
                                        </div>
                                    </td>
                                    <td style="width:100%;">
                                        <label class = "mdl-radio mdl-js-radio" for = "student">
                                            <input type = "radio" id = "student" name = "usertype" value="student" class = "mdl-radio__button" checked>
                                            <span class = "mdl-radio__label">Student</span>
                                        </label>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <label class = "mdl-radio mdl-js-radio" for = "faculty">
                                            <input type = "radio" id = "faculty" name = "usertype" value="faculty" class = "mdl-radio__button">
                                            <span class = "mdl-radio__label">Faculty</span>
                                        </label>
                                    </td>
                                </tr>
                                <!--<tr>
                                    <td>
                                        <input type="hidden" name="courseid" value=<?php intval($_GET['courseid'])?>>
                                    </td>
                                </tr>-->
                            </table>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <p>
                                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type="submit" name="submit">
                                    Submit
                                </button>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
            <footer class="mdl-mini-footer">
                <div class="mdl-mini-footer__left-section">
                    <div class="mdl-logo">Corseportal website</div>
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
