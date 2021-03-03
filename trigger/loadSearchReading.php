<?php 
	session_start();
 if(!isset( $_SESSION['emp_id']))
      {
        header("Location:../index.html");
      } 
      					$txtMeter = $_POST['meter'];
                        include("conn.php");
                        $sql="SELECT * FROM meter INNER JOIN meterreading ON meter.meter_id = meterreading.meter_id INNER JOIN customer ON meter.cus_id=customer.cus_id where meter_serialNo = '$txtMeter' ORDER BY readingDate DESC LIMIT 1";
                        $query = mysqli_query($conn,$sql);
                        $row = mysqli_fetch_array($query,MYSQLI_ASSOC);
                        

                         if (mysqli_num_rows($query) > 0) {
                          if ($row['meter_status']==0) {
                            echo "Status: Deactivated";
                            //$_SESSION['noSearchFoundMessage'] = "Opps... Looks like this account has been deactivated by the admin, this meter cannot be read.";
                          }else{
                            ?>
                                <div class="col-12 table-responsive">
                                  <table class="table table-striped">
                                     <thead>
                                        <tr>    
                                        <th>ID</th>
                                        <th>Meter Serial No</th>
                                        <th>Action</th>
                                        </tr>
                                      </thead>
                                    <tr>
                                      <td>
                            <?php
                            $_SESSION['meter_serialNo'] = $row['meter_serialNo'];
                            $meterID = $row['meter_id'];
                            $_SESSION['meterID'] = $meterID;
                            $cusID = $row["cus_id"];
                            $_SESSION['cus_id'] = $cusID;

                            $_SESSION['meter_type'] = $row["meter_type"];
					             $_SESSION["readingDate"] = $row["readingDate"];
                      $_SESSION["cubicMeterConsume"] = $row["cubicMeterConsume"];
                      $_SESSION["previousMonthReading"] = $row["reading"];
                      $_SESSION["paidStatus"] = $row['paid_status'];

                      $_SESSION["cusfname"]=$row["cus_fname"];
                      $_SESSION["cusmname"]=$row["cus_mname"];
                      $_SESSION["cuslname"]=$row["cus_lname"];
                      $_SESSION["cusAddress"]=$row['cus_address'];
                      $_SESSION['cus_category'] = $row['cus_category'];
                            echo $meterID; 
                            ?>
                                    </td>
                              <td>
                            <?php 
                              echo $_SESSION['meter_serialNo']."<td><a class='btn btn-primary btn-rounded' id='readText' data-toggle='modal' data-target='#modalReading'>READ</a>";
                     
                      
                      
                      $closeconnection=mysqli_close($conn);
                         }
                     }
                         else{
                         
                            echo "Status: No Search Found";
                         }
                    ?>
                  </td>
                  </tr>
        
      </table>
  </div>
  <div class="modal fade" id="modalReading" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
          aria-hidden="true">
          <div class="modal-dialog cascading-modal" role="document">
            <!-- Content -->
              <div class="modal-content">
         
              <!-- Header -->
                <div class="modal-header light-blue darken-3 white-text">
                  <h4 class=""><i class="fas fa-pencil-alt"></i> Meter Serial No:
                    <?php  
                        echo $_SESSION['meter_serialNo'];
                      ?>
                 </h4>

                <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                </button>

               <h4 class=""><i class="fas fa"></i>Previous Reading:
                    <?php 
                      echo $_SESSION["previousMonthReading"]." m2";
                    ?>
                </h4>
                 </div>

                 <div class="modal-body mb-0">
                <h4 class=""><i class="fas fa"></i>Meter Owner:
                    <?php 
                      echo "Mr/Mrs ".$_SESSION["cuslname"];
                    ?>
                  </h4>
                <div class="md-form form-sm">
                  <input type="Number" id="txtPresentReading" class="form-control" autofocus="">
                </div>
                 
                <div class="text-center mt-1-half">

                    <button class="btn btn-info mb-2" id="btnEnterPresentReading" >Enter<i class="fas fa-paper-plane ml-1"></i></button>
            </div>
            
                </div>
                </div>
               </div>
            
    </div>
    <script>
    	$(document).ready(function(){
    		$("#btnEnterPresentReading").click(function(e){
      var txtPresentReading = document.getElementById("txtPresentReading").value;
      var txtprevread = <?php echo  $_SESSION["previousMonthReading"]; ?>;
      if (txtPresentReading === "") {
        Swal.fire({
                    icon: 'warning',
                    title: 'Invalid',
                    text: 'Please fill out all fields, Thank you',
                    showConfirmButton: true
                  });
      }
      else if(txtPresentReading < txtprevread){
      	        Swal.fire({
                      icon: 'error',
                      title: 'INVALID',
                      text: 'You input less than the previous reading, please input correct details',
                      showConfirmButton: true
                      });
      }
      else{
      	$.ajax({
        url:'trigger/enterPresentReading.php',
        method: 'POST',
        data: {txtPresentReading:txtPresentReading},
        success :  function(enterPresentReading){
             if (enterPresentReading === 'ok') {
             location.href='previewData.html';
             }
           }
      	}); 
      }
    });
    	});
    </script>