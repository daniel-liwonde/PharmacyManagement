<?php
require_once("data.php");
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Cashier Sales Report</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script src="bootstrap/js/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="font6/css/all.css">
    <link rel="shortcut icon" href="" type="image/x-icon">
    <link rel="stylesheet" href="font6/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/sidenav.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/home.css">
      <link rel="stylesheet" href="css/style.css">
    <script src="js/reportcashier.js"></script>
    <script src="js/restrict.js"></script>
     <script src="js/charts.js"></script>
  </head>
  <body>
    <!-- including side navigations -->
    <?php
    session_start();
    include("sections/sidenav.php"); ?>

    <div class="container-fluid" style="width:82%; margin-left:18%"> 
      <div class="container">

        <!-- header section -->
        <?php
          require "php/header.php";
          createHeader('folder-open', 'Sales Report', '<i class="fa fa-user"></i><i class="fa fa-coins"></i>&nbsp;Cashier Sales Report');
        ?>
        <!-- header section end -->

        <!-- form content -->
        <div class="row" style="margin-top:45px">
          <div class="col-md-12 form-group form-inline">
            <select class="form-control" id="cashier_id"  onchange="showReport('Cashier');" required>
                <option value="">Select Cashier</option>
                <?php
                include("php/db_connection.php");
                $prod=mysqli_query($con,"SELECT * FROM admin_credentials WHERE ROLE=2") or die(mysqli_error($con));
                while($getProd=mysqli_fetch_assoc($prod))
                {
                    ?>
                  <option value="<?php echo $getProd['USER_ID']?>"><?php echo $getProd['LNAME']." ".$getProd['FNAME'] ?></option>
                    <?php
                }
                ?>
            </select>
            &nbsp;
            
            &nbsp;From:&nbsp;
             <input type="date" class=" form-control" id="start_date" onchange="showReport('Cashier');" >
            &nbsp;
             &nbsp;To:&nbsp;
            <input type="date" class="form-control" id="end_date" onchange="showReport('Cashier');dowork()">
            &nbsp;
           

            <button class="btn btn-success set" onclick="location.reload();"><i class="fa fa-refresh"></i></button>
          </div>
          <div class="col col-md-12">
            <hr class="col-md-12" style="padding: 0px; border-top: 2px solid  #02b6ff;">
          </div>

          <div class="col col-md-12 table-responsive">
            <div id="print_content" class="table-responsive">
            	<table class="table table-bordered table-striped table-hover" id="Cashier_report_div">
      
            	
            </table>
           
       </div>
            </div>
             <div id="chartContainer2" style="height: 370px; width: 100%;"></div>
          </div>

          <div class="col-md-12 text-center">
            <button class="btn btn-primary" onclick="printReport('Sales');">Print</button>
          </div>
         
        </div>
        <!-- form content end -->
        <hr style="border-top: 2px solid #ff5252;">
      </div>
    </div>
      
    </body>
</html>
