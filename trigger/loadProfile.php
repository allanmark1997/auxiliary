<!DOCTYPE html>
  <?php 
 session_start();
 if(!isset( $_SESSION['emp_id']))
      {
        header("Location:../index.html");
      } 
 ?>
<html>
<head>
</head>
<body>
  
    <div class="col-md-8">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="widget-user-header text-white avatar mx-auto" style="background-repeat: no-repeat; margin-top: 0px; background-position: center center;">
                  <img class=""
                       src="Central_Mindanao_University_logo.png"
                       alt="User background">
        </div>
        <div class="text-center avatar mx-auto"  style="margin-top: -75px";>
                  <img class="img-fluid rounded-circle z-depth-4"
                      <?php 
                        $userLowerCase = strtolower($_SESSION['emp_fname']);
                      ?>
                       src="profiles/<?php 
                          if (file_exists("../profiles/".$userLowerCase.".jpg")==true) {
                             echo $userLowerCase;
                         }else{
                              echo "default";
                         }
                         ?>.jpg"
                       alt="User profile picture"
                       width='125' height='125'>

                </div>
                <h3 class="profile-username text-center"><?php  echo $_SESSION['emp_fname']." ".$_SESSION['emp_mname']." ".$_SESSION['emp_lname']; ?></h3>

                <p class="badge badge-success text-muted text-center">
                <?php 
                  if ($_SESSION['emp_position']==0) {
                    echo "Meter Reader";
                  }elseif ($_SESSION['emp_position']==1) {
                    echo "Administrator";
                  }else{
                    echo "Staff";
                  }
               ?>
                 
               </p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Central Mindanao University</b><br> <a class="float-center">C - Commitment <br> M - Moral Integrety <br> U - Unity in Diversity</a>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">AUXILIARY STAFFS</h3>
              </div>
              <?php 
                    include("conn.php");
                    $sql="SELECT * FROM employee ORDER BY emp_dateCreated ASC";
                    $query = mysqli_query($conn,$sql);
                    while ( $row = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
                    $usersActiveAndDeactivatedNameLowerCase = strtolower($row['emp_fname']);
                 ?>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="text-center avatar mx-auto"  style="margin-top: 0px";>
                  
                  <img class="img-fluid rounded-circle z-depth-4"
                       src="profiles/<?php 
                      if (file_exists("../profiles/".$usersActiveAndDeactivatedNameLowerCase.".jpg")==true) {
                      echo $usersActiveAndDeactivatedNameLowerCase;
                      }else{
                      echo "default";
                        }
                      ?>.jpg"
                       alt="User profile picture"
                       width='125' height='125'>

                </div>
                <h4 class="profile-username text-center"><?php echo $row['emp_fname']." ".$row['emp_mname']." ".$row['emp_lname']; ?></h4>
                <p class="text-muted text-center"><?php 
                    if ($row['emp_position']==0) {
                      echo "Meter Reader";
                    }elseif ($row['emp_position']==1) {
                      echo "Administrator";
                    }else{
                      echo "Staff";
                    }
                     ?></p>
                     <?php 
                     if ($row['emp_status']==0) {
                      ?>
                    <span class="badge badge-danger ">Deactivated</span>
                    <?php
                    }
                     elseif ($row['emp_status']==1) {
                      ?>
                    <span class="badge badge-success ">Active</span>
                    <?php 
                    } 
                    ?>
                <hr>
            
              </div>
              <?php
                 }
              ?>
              <!-- /.card-body -->
            </div>
  </div>
</body>
</html>