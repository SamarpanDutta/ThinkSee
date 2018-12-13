<?php
include('includes/database.php');
$courseid = intval($_GET['courseid']);
if(isset($_POST["Import"]))
{
	$filename=$_FILES["file"]["tmp_name"];		
    if($_FILES["file"]["size"] > 0)
    {
        $file = fopen($filename, "r");
        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
        {
            $sql = "INSERT into coursecontent (`courseid`, `contentname`, `url`) VALUES(".$courseid.",'".$getData[0]."','".$getData[1]."')";
            $result = mysqli_query($link, $sql);
            if(!isset($result))
            {
                echo "<script type=\"text/javascript\">
                        alert(\"Invalid File:Please Upload CSV File.\");
                      </script>";	
                header('Location:student_homepage.php');	
            }
            else 
            {
                echo "<script type=\"text/javascript\">
                            alert(\"CSV File has been successfully Imported.\");
                     </script>";
                    header('Location:student_homepage.php');
            }
         }
         fclose($file);	
         mysqli_close($link);
    }
}	 
?> 