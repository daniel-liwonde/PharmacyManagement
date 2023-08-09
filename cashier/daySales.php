<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Daily Sales</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script src="bootstrap/js/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
     <link rel="stylesheet" href="font6/css/all.css">
    <link rel="shortcut icon" href="" type="image/x-icon">
    <link rel="stylesheet" href="font6/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/sidenav.css">
    <link rel="stylesheet" href="css/home.css">
	<link rel="stylesheet" href="css/style.css">
    <script src="js/report.js"></script>
    <script src="js/restrict.js"></script>
  </head>
  <body>
    <!-- including side navigations -->
    <?php 
	session_start();
  $cashier_id= $_SESSION['USER_ID'];
	include("sections/sidenav.php"); ?>

    <div class="container-fluid" style="width:82%; margin-left:18%">
      <div class="container">

        <!-- header section -->
        <?php
          require "php/header.php";
          createHeader('book', 'Cashier Report', '<i class="fa fa-list"></i> &nbsp;Specific Report');
          
        ?>
        <!-- header section end -->

        <!-- form content -->
        <div class="row" style="margin-top:45px">
          <div class="col col-md-12 table-responsive">
            <div id="print_content" class="table-responsive">
            	<table class="table table-bordered table-striped table-hover" id="purchase_report_div">
                <?php
                require "php/report.php";
               showCashierSalesDaily("","",$cashier_id); 
                ?>
            	</table>
            </div>
          </div>

          <div class="col-md-12 text-center">
            <input type="hidden" id="start_date" value="">
             <input type="hidden" id="end_date" value="">
              <input type="hidden" id="cashier" value="<?php  echo $_SESSION['LNAME']; ?>">
            <button class="btn btn-primary" onclick="printReport('Sales');">Print</button>
          </div>

        </div>
        <!-- form content end -->
        <hr style="border-top: 2px solid #ff5252;">
      </div>
    </div>
  </body>
</html>
