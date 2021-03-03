<?php 
       session_start();
       if(!isset( $_SESSION['emp_id']))
      {
        header("Location:../index.html");
      }               
                      include_once "conn.php";
                      $sql="SELECT * FROM meterreading";
                      $query = mysqli_query($conn,$sql);
                      $totalMeterRead = 0;
                     
                      $pdate = date("Y-m");
                      $pdateArray = preg_split("/-/", $pdate);
                      while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
                         $dateString = $row['readingDate'];
                          $stringArray = preg_split("/-/", $dateString);
                      if ($stringArray[0] == $pdateArray[0] and $stringArray[1] == $pdateArray[1]){
                        $totalMeterRead += 1;
                      }

                      }
                      echo $totalMeterRead;
                      $closeconnection=mysqli_close($conn);
?>