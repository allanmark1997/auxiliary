<?php 
	session_start();
      if(!isset( $_SESSION['emp_id']))
      {
        header("Location:../index.html");
      } 

                      $meterIDs = $_SESSION['meterID'];
                      include("conn.php");
                      $sql="SELECT * FROM meterreading WHERE meter_id = '$meterIDs'";
                      $query = mysqli_query($conn,$sql);
                      $existReading = false;

                      $pdate = date("Y-m");
                      $pdateArray = preg_split("/-/", $pdate);
                      while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
                          $dateString = $row['readingDate'];
                          $stringArray = preg_split("/-/", $dateString);
                            if ($stringArray[0] == $pdateArray[0] and $stringArray[1] == $pdateArray[1]){
                                $existReading = true;
                            }

                      }
                    $closeconnection=mysqli_close($conn);

                    if ($existReading == false) {
                        $empID = $_SESSION['emp_id'];

                        $presentReadings = $_SESSION["txtPresentReading"];
                        $totalPayment = $_SESSION['subtotal'];
                        $totalMeterConsume = $_SESSION['result'];
                        $meterID = $_SESSION['meterID'];
                        $due_date = date('Y-m-d', strtotime('+1 month'));
                        $paidStatus = 0;
                        $date = date("Y-m-d");
                        include("conn.php");
                        $sql = "INSERT INTO meterreading (reading, amount, cubicMeterConsume, readingDate,meter_id, emp_id, paid_status, due_date) 
                                    VALUES ('$presentReadings', '$totalPayment', '$totalMeterConsume', '$date', ' $meterID', '$empID', '$paidStatus', '$due_date')";
                        $query = mysqli_query($conn,$sql);

                         if ($query) {
                           
                              echo "saved";
                            }
                          else{
                          	echo "errors";
                          }
                        }
                    elseif($existReading == true)
                      {
                        echo "error";
                      } 
 ?>