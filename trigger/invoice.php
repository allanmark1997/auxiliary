<!DOCTYPE html>
<?php 
  session_start();
      if(!isset( $_SESSION['emp_id']))
      {
        header("Location:../index.html");
      } 
       ?>
<html>
<script type="text/javascript">
   window.addEventListener("load", window.print());
  </script>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CENTRAL MINDANAO UNIVERSITY</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 4 -->


<!-- header logo -->
<link rel="icon" href="../Central_Mindanao_University_logo.png" type="image/x-icon">


  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons 
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">-->
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">

  <!-- Google Font: Source Sans Pro 
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">-->
</head>
<body>
  <div class="col-xl-5 col-lg-4 col-md-5 col-sm-12 mx-auto">
      
  
<div class="wrapper " >
  <!-- Main content -->
  <section class="invoice" >
    <!-- title row -->
    <div class="row" align="center">
<i class=""> <img src="../Central_Mindanao_University_logo.png" width="80" height="80" align="center"></i>
      <div class="col-9" align="left">
        
        <h3 class="page-header"><b><small>  
          CENTRAL MINDANAO UNIVERSITY AUXILIARY OFFICE WATER BILLING</small></b>
        </h3>
      </div>
      <!-- /.col -->
    </div>

    <div class="row" align="center">
      <div class="col-12" align="center"><small> 
        <h4 class="page-header">
          STATEMENT OF ACCOUNT<br>
        </h4></small>
        <h5><small class="float-center">For the month of
            <?php 
              if (date("m") == 1) {
                echo "January".date("Y");
              }
              elseif (date("m") == 2) {
                echo "February".date("Y");
              }
              elseif (date("m") == 3) {
                echo "March ".date("Y");
              }
              elseif (date("m") == 4) {
                echo "April ".date("Y");
              }
              elseif (date("m") == 5) {
                echo "May ".date("Y");
              }
              elseif (date("m") == 6) {
                echo "June ".date("Y");
              }
              elseif (date("m") == 7) {
                echo "July ".date("Y");
              }
              elseif (date("m") == 8) {
                echo "August ".date("Y");
              }
              elseif (date("m") == 9) {
                echo "September ".date("Y");
              }
              elseif (date("m") == 10) {
                echo "October ".date("Y");
              }
              elseif (date("m") == 11) {
                echo "November ".date("Y");
              }
              elseif (date("m") == 12) {
                echo "December ".date("Y");
              }
             ?>
          </small></h5>
      </div>
      <!-- /.col -->
    </div>

    <div class="row">
      <div class="col-12" align="left">
        <h7>
          <small>
          CONSUMER INFORMATION
        </small>
        </h7>
        <br>
        <hr>
      </div>
    </div>

    <div class="row invoice-info">
      <div class="col-sm-5 invoice-col">
        <address><small>  
          Meter No:
            <?php 
              echo $_SESSION['meterSerialNo'];
            ?>
          <br>
          Name: 
          <strong>
            <?php 
            echo $_SESSION["cusfname"]." ".$_SESSION["cusmname"]." ".$_SESSION["cuslname"];
             ?>
          </strong><br>
          Address:
          <?php 
          echo $_SESSION["cusAddress"];
           ?>
        </address>
         </div>
         <div class="col-sm-10 ">
           <address>
            <small>

              Residential Type:
             <?php 
                if ($_SESSION['meter_type']==1) {
                  echo "Employee Household";
                }
                elseif ($_SESSION['meter_type']==0) {
                  echo "Private Household";
                }
              ?>
            </small>
            <br>
           Customer Type: 
          <?php 
              echo $_SESSION['cus_category'];
           ?>
           </address>
         </div>
    </div>
        <div class="row">
          <div class="col-12" align="left"> 
            <h7>
              <small>
                CONSUMPTION DETAILS
              </small>
            </h7>
            <hr>
          </div>
        </div>
        <div class="row">
          <div class="col-6" align="left">
            <address> <small> 
            Period Covered: 
          <?php 
            echo "( ".$_SESSION["readingDate"]." ) to ( ".date("Y-m-d")." )";
           ?>
          <br>
          Present Reading: (
          <?php 
            echo $_SESSION["txtPresentReading"];
           ?> )
           <br>
          Previous Reading: (
          <?php 
           echo $_SESSION["previousMonthReading"];
           ?> )
           <br>
           Last Month Meter Consume: ( 
           <?php 
           echo $_SESSION["cubicMeterConsume"]." <img src='../cubicLogo.png' width='9' height='9' align='center'>";
            ?> )
            <br>
            <h6>
            CUBIC METER USED: (
            <?php 
              echo $_SESSION['result'];
             ?> )</h6>
             </small>
           </address>
          </div>
          <div class="col-sm-6 ">
           <address>
            <small>
          Minimum: (
          <?php 
           echo $_SESSION['minimum']." <img src='../cubicLogo.png' width='9' height='9' align='center'>";
           ?> )
           <br>
           Present Rate per Cubic meter:( Php. 
           <?php 
           echo $_SESSION['existRate'];
            ?> )
            </small>
          
           </address>
         </div>
        </div>
          
    <div class="row">
      <div class="col-12" align="left"> 
        <h7>
          <small>
            COMPUTATION DETAILS
        </small>
        </h7>
        <hr>
      </div>
    </div>

    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-12 table-responsive">
            <table class="table table-striped">
          <thead>
          <tr align="center">
            <tr>    
            <th></th>
            <th>Meter Consume</th>
            <th>Minimum</th>
            <th>Excess Rate</th>
            <th>Subtotal</th>
          </tr>
          <tr align="center">
            <td><small> 
              Generation Water Charge
            </small>
            </td>
            <td><?php   echo $_SESSION['result']; ?></td>
            <td>
              - <?php   echo $_SESSION['minimum']; ?> <img src='../cubicLogo.png' width='9' height='9' align='center'>
            </td>
            <td><?php   echo $_SESSION['existRate']; ?> / <img src='../cubicLogo.png' width='9' height='9' align='center'></td></td>
            <td>PHP. <?php
             echo "<b>".$_SESSION['subtotal']; ?></b></td>
          </tr>
          </thead>
        </table>
      </div>
      </div>
      

      <div class="row invoice-info">
      <div class="col-sm-3 invoice-col">
        
      </div>
      <!-- /.col -->
    </div>

    <div class="row">
      <div class="col-12" align="left">
        <h7>
          <small>
           OVERALL TOTAL WITH BACK ACCOUNTS
        </small>
        </h7>
        <br>
        <hr>
      </div>
    </div>

    <div class="row" align="center">
      <div class="col-12 table-responsive" align="center">
        <table class="table table-striped" align="center">
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
             $closeconnection=mysqli_close($conn);
            include("conn.php");
            $sql="SELECT * FROM meterreading WHERE meter_id = '$meterSelectedID' AND paid_status = 0";
            $query = mysqli_query($conn,$sql);
            while ( $row = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
            
             ?>
             <tr align="center">
              <td><?php echo $row['readingDate']; ?></td>
              <td><b><?php echo $row['cubicMeterConsume']; ?></b><img src='../cubicLogo.png' width='10' height='10' align='center'></td>
              <td>Previous reading(s) not paid yet.</td>
              <td><p class="font-weight-bold dark-black-text" id="previousAmount">PHP. <?php echo $row['amount']; ?></p></td>
            </tr>
             <?php 
            }
            $newSubtotal = $_SESSION['previousTotalBalance'] + $_SESSION['subtotal'];
             $closeconnection=mysqli_close($conn);
             ?>
         
          <tr align="center">
            <td><?php $date = date('Y-m-d'); echo $date; ?></td>
            <td><b><?php echo $_SESSION['result']; ?></b> <img src='../cubicLogo.png' width='9' height='9' align='center'></td>
            <td>Present reading. Not paid yet</td>
            <td><b>PHP. <?php echo $_SESSION['subtotal']; ?></b></td>
          </tr>
        </table>
      </div>
      <!-- /.col -->
    </div>

    <div class="row">
      <!-- accepted payments column -->
    
      <!-- /.col -->
      <div class="col-12">
        <p class="lead">Amount Due <?php $date = date("Y/m/d"); echo $date; ?></p>

        <div class="col-12 table-responsive">
          <table class="table">
            <small> 
            <tr>
              <th style="width:50%">BACK ACCOUNT(S) TOTAL:</th>
              <td>PHP. 
                <?php 
                  echo $_SESSION['previousTotalBalance'];
                 ?>
              </td>
            </tr>
            <tr>
              <th>CURRENT BILL:
              </th>
              <td>PHP. <?php echo $_SESSION['subtotal']; ?></td>
            </tr>
            <tr>
              <th>GRAND TOTAL:</th>
              <td>PHP. <b>
                <?php 
                 echo $newSubtotal;
                 ?>
                   </b>
                 </td>
            </tr></small>
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>

    <div class="row"  >
      
    </div>
     <div class="row">
      <div class="col-12" align="center"><small> 
        <b>DUE DATE: </b> <?php $date = date('Y-m-d', strtotime('+1 month'));
      echo $date; ?><br>
        <b>DISCONNECTION DATE: </b> <?php $dateDiscon = date('Y-m-d', strtotime('+1 month, +3 day'));
      echo $dateDiscon; ?>
      </small>
    </div>
    </div>
    <div class="row"  >
      <div class="col-12" align="left">
        <hr>
      </div>
    </div>
    <div class="row"  >
      <div class="col-12" align="left">
        <small> 
        Meter Reader: <?php   echo $_SESSION['emp_fname']." ".$_SESSION['emp_mname']." ".$_SESSION['emp_lname']; ?>
        <br>  
        Recieved by:
        </small>
      </div>
    </div>
    <div class="row"  >
      <div class="col-12" align="left">
        <hr>
      </div>
    </div>
    <div class="row"  >
      <div class="col-12" align="center">
        <p> <small> 
        This serves as NOTICE OF DISCONNECTION when your account becomes due.
        <br>  
        THANK YOU!!!
        <br>  
        ***AVOID PENALTY, PAY YOUR BILLS ON TIME***
      </small></p>
      <?php   
        include'barcode.php';
       ?>
       <p align="center"><img src="barcode.php?f=jpg&s=ean13pad&d=<?php  echo $_SESSION['meterSerialNo']; ?>&sf=8&ms=r&md=0.8" height="30px" width="300px" align="center"> </p>
      </div>
    </div>







  </div>
    <!-- /.row -->

    <!-- Table row -->
    
    <!-- /.row -->

    

    
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
</div>
<!-- ./wrapper -->
<form name="frmReadingss" method="get" action="../previewData.html">
  <input type="text" name="txtNone" autofocus="" transparent >
<button name="btnreturn" hidden="">RETURN</button>
</form>
<script type="text/javascript"> 
 
 // location.href='inputPresentReading.php';
</script>
<?php //header("Location: inputPresentReading.php");
if (isset($_POST['btnreturn'])) {
   echo "<script>location.href='../previewData.html'</script>";
 } ?>
</body>
</html>
