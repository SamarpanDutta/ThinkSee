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