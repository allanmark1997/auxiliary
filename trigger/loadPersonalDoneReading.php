
<?php 
  session_start();
      if(!isset( $_SESSION['emp_id']))
      {
        header("Location:../index.html");
      } 
       ?>
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

<link rel="stylesheet" href="plugins/datatables-autofill/css/autoFill.bootstrap4.css">

          <div class="card-body">
             
            <p class="h5 text-left mb-4"><strong><b><?php echo ' " '.date("Y-M").' " '; ?>Present Readings</b></strong></p>
            <p class="h3 text-center mb-4"><strong><b>

             </b></strong></p>
          <div class="col-12 table-responsive">
            <table class="table table-striped" id="example2">
              <thead>
                <tr align="center">    
                  <th>Date</th>
                  <th>Meter Serial</th>
                  <th>Meter Owner</th>
                  <th>Payment Status</th>
                </tr>
              </thead>
                
                <tbody>
                <?php 
                      include("conn.php");
                      $sql="SELECT * FROM meterreading INNER JOIN meter ON meterreading.meter_id = meter.meter_id INNER JOIN customer ON meter.cus_id = customer.cus_id";
                      $query = mysqli_query($conn,$sql);
                     
                      $pdate = date("Y-m");
                      $pdateArray = preg_split("/-/", $pdate);
                      while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
                         $dateString = $row['readingDate'];
                          $stringArray = preg_split("/-/", $dateString);
                      if ($stringArray[0] == $pdateArray[0] and $stringArray[1] == $pdateArray[1]){
                        if ($row['emp_id'] == $_SESSION['emp_id'])
                        {
                     ?>

                <tr align="center">
                  <td><?php 
                      echo $row['readingDate'];
                  ?></td>
                  <td>
                      <?php 
                        echo $row['meter_serialNo'];
                      ?>
                  </td>
                  <td>
                      <?php 
                        echo $row['cus_lname'];
                       ?>
                  </td>
                  <td><?php
                        if ($row['paid_status'] == 0) {
                          echo "<span class='badge badge-danger'>Not paid</span>";
                        }elseif ($row['paid_status'] == 1) {
                          echo "<span class='badge badge-success'>Paid</span>";
                        }
                        else{
                          echo "<span class='badge badge-warning'>Something went wrong!</span>";
                        }
                      ?>
                  </td>
                </tr>
                <?php 
                          }
                          }

                      }
                      $closeconnection=mysqli_close($conn);
                 ?>
                 </tbody>
            </table>
          </div>

          </div>

  <!-- DataTables -->
  <script src="plugins/datatables/jquery.dataTables.js"></script>
  <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

<script>
  $(function () {
   // $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>
