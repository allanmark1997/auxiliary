<?php 
	session_start();
 if(!isset( $_SESSION['emp_id']))
      {
        header("Location:../index.html");
      } 

                      $_SESSION["txtPresentReading"] = $_POST['txtPresentReading'];
 
                              include("conn.php");
                              $sql="SELECT * FROM rate";
                              $query = mysqli_query($conn,$sql);
                              $row = mysqli_fetch_array($query,MYSQLI_ASSOC);
                              $_SESSION['existRate'] = $row['existRate'];

                              if ($_SESSION['meter_type'] == 1) {
                                 $_SESSION['minimum'] = $row['mininumEmployee'];
                              }
                              elseif ($_SESSION['meter_type'] == 0){
                                  $_SESSION['minimum'] = $row['minimumPrivate'];
                              }
                              else{
                                  $_SESSION['minimum'] = 0;
                                  }
                              $closeconnection=mysqli_close($conn);


                          if ($_SESSION['minimum'] == 0) {
                              $_SESSION['result'] = 0;
                          }
                         else{
                             

                              $result = $_SESSION["txtPresentReading"] - $_SESSION["previousMonthReading"];
                              $_SESSION['result'] = $result;


                              if ($_SESSION['minimum'] < $result ) {
                                $subtotalPayment = $result - $_SESSION['minimum'];
                                $_SESSION['subtotal'] = ($subtotalPayment * $_SESSION['existRate']) + 100;
                              }
                              elseif ($_SESSION['result'] == 0) {
                                $_SESSION['subtotal'] = 0;
                              }
                              else
                              {
                                $_SESSION['subtotal'] = 100;
                              }
                          }
                          echo "ok";
 ?>