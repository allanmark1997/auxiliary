
<?php 
  session_start();
      if(!isset( $_SESSION['emp_id']))
      {
        header("Location:../index.html");
      } 
       ?>

            <h5 class="my-4 dark-grey-text font-weight-bold">Result</h5>
            <p class="h2 text-center mb-4"></p>
            <p class="h6 text-left mb-4"><strong><b>Meter Type: </b></strong>
              <?php 
                    if ($_SESSION['meter_type'] == 1) {
                      echo "Employee Household";
                    }
                    else
                    {
                      echo "Private Household";
                      $meterType = $row['meter_type'];
                    }
                  
                  echo " - minimum (". $_SESSION['minimum'] ." <img src='cubicLogo.png' width='13' height='13' align='center'>)";
              
               ?></p>

            <p class="h6 text-left mb-4"><strong>Name: </strong>
              <?php 
              echo $_SESSION["cusfname"]." ".$_SESSION["cusmname"]." ".$_SESSION["cuslname"];
     
             ?> </p>

              
               <p class="h6 text-left mb-4"><strong><b>Address: </b></strong>
               <?php 
                echo $_SESSION["cusAddress"];
                ?> </p>

            <p class="h5 text-left mb-4"><strong>Last Reading: </strong>
            
              <?php 
               
                 echo "(".$_SESSION["previousMonthReading"].")";

                 ?>

                 <p class="h5 text-left mb-4"><strong>Last Meter Consume: </strong>

                <?php
                  echo "(".$_SESSION["cubicMeterConsume"]." <img src='cubicLogo.png' width='13' height='13' align='center'>)";
               
               ?>
            </p>
            <p class="h5 text-left mb-4"><strong>Last Meter Date Reading: </strong></p>
            <p class="h4 text-center mb-4">
              <?php   
                     echo $_SESSION["readingDate"];
               ?>
            </p>


            <hr>
            <div id="loadPreviousBalances">
              <p class="h5 text-left mb-4"><strong><b>Previous Balance: </b></strong></p>
             <div class="col-12 table-responsive">
            <table class="table table-striped">
          <thead>
          <tr align="center">    
            <th>Date</th>
            <th>Meter Consume</th>
            <th>Description</th>
            <th>Subtotal</th>
          </tr>
          </thead>
          <?php
            
            $meterSelectedID = $_SESSION['meterID'];
            include("conn.php");
            $sql="SELECT * FROM meterreading WHERE meter_id = '$meterSelectedID' AND paid_status = 0";
            $query = mysqli_query($conn,$sql);
            $totalBalance = 0;
            while ( $row = mysqli_fetch_array($query,MYSQLI_ASSOC)) { 
              $totalBalance += $row['amount'];
            ?>
            <tr align="center">
              <td><?php echo $row['readingDate']; ?></td>
              <td><b><?php echo $row['cubicMeterConsume']; ?></b><img src='cubicLogo.png' width='10' height='10' align='center'></td>
              <td>Previous reading(s) not paid yet.</td>
              <td><p class="font-weight-bold dark-black-text" id="previousAmount">PHP. <?php echo $row['amount']; ?></p></td>
            </tr>

            <?php 

            }
            
            $_SESSION['previousTotalBalance'] = $totalBalance;
             $closeconnection=mysqli_close($conn);
             ?>
        </table>
      </div>
            </div>
            
            <p class="h5 text-left mb-4"><strong><b>Present Reading: </b></strong></p>
            <p class="h3 text-center mb-4"><strong><b>
              <?php 
             
                echo $_SESSION["txtPresentReading"];
              
               ?>
             </b></strong></p>
          <div class="col-12 table-responsive">
            <table class="table table-striped">
          <thead>
          <tr align="center">    
            <th>Date</th>
            <th>Meter Consume</th>
            <th>Description</th>
            <th>Subtotal</th>
          </tr>
          <tr align="center">
            <td><?php $date = date('Y-m-d'); echo $date; ?></td>
            <td>
              <?php 
                  echo "<b>".$_SESSION['result']."</b>";
               ?>
            <img src='cubicLogo.png' width='10' height='10' align='center'></td>
            <td>Present reading. Not paid yet</td>
            <td><p class="font-weight-bold dark-black-text" id="presentSubtotal"></p></td>
          </tr>
          </thead>
        </table>
      </div>
         
            <p class="h5 text-left mb-4" id="totalPayment"></p>
            <script>
              var minimum = <?php echo $_SESSION['minimum']; ?>;
              var totalPayment = <?php echo $_SESSION['previousTotalBalance'] + $_SESSION['subtotal']; ?>;
              var subtotal = <?php echo $_SESSION['subtotal']; ?>;

              document.getElementById("presentSubtotal").innerHTML = "PHP. " + subtotal.toFixed(2);

              if (minimum === 0) {
                document.getElementById("totalPayment").innerHTML = "No Data";
              }
              else
              {
                $("#totalPayment").html("<strong><b>Total Payment: PHP. " + totalPayment.toFixed(2) + "</b></strong>");
              }
            </script>


                <div class="text-center mt-4">
                  <button class="btn purple-gradient btn-rounded" id="btnSave"><b>Save<i class="fas fa-paper-plane ml-1"></i></b></button>

                   <div class="modal fade" id="modalContactFormss" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
          aria-hidden="true" data-backdrop="false">
          <div class="modal-dialog cascading-modal" role="document">
            <!-- Content -->
            <div class="row">

          <h2 class="mt-5 mb-3 pt-4 black-text font-weight-bold"><b><strong>...Processing... Please Wait...</strong></b></h2>

           <div class="col-md-4">

          <div class="preloader-wrapper big active">

              <div class="spinner-layer spinner-blue-only">

                <div class="circle-clipper left">
                  <div class="circle"></div>
                </div>

                <div class="gap-patch">
                  <div class="circle"></div>
                </div>

                <div class="circle-clipper right">
                  <div class="circle"></div>
                </div>

              </div>

            </div>
          </div>

        </div>
               </div>
            </div>


                  <button class="btn purple-gradient btn-rounded" id="btnPrint" data-toggle="modal" data-target="#modalContactFormss"><b>Print Preview<i class="fas fa-paper-plane ml-1"></i></b></button>
                </div>

    </div>

            </div>

          </div>
          <!--Card -->

        </div>
  <script>
    $(document).ready(function(){
      $('#btnPrint').click(function(){
        location.href='trigger/invoice.php';
      });

      $('#btnSave').click(function(){
        $.ajax({
          url:'trigger/savePresentReading.php',
          method: 'POST',
          success: function(data){
            if(data==="saved"){
              Swal.fire({
                        icon: 'success',
                        title: 'Saved!',
                        text: 'Present reading has been saved to the database.',
                        showConfirmButton: true
                      })
            }
            else if (data==="error") {
              Swal.fire({
                        icon: 'error',
                        title: 'Opps... error occured!',
                        text: 'This meter has been already done reading by other meter reader, reading must be done once only! Please read another meter.',
                        showConfirmButton: true
                      })
            }
            else if (data==="errors") {
              Swal.fire({
                        icon: 'error',
                        title: 'Opps... error occured!',
                        text: 'Something Went Wrong!',
                        showConfirmButton: true
                      })
            }

          }
        });
      });
    });
  </script>
</body>

</html>
