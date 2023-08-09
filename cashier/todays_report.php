<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Todays Report</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script src="bootstrap/js/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
     <link rel="stylesheet" href="font6/css/all.css">
    <link rel="shortcut icon" href="" type="image/x-icon">
    <link rel="stylesheet" href="font6/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/sidenav.css">
    <link rel="stylesheet" href="css/home.css">
    <script src="js/report.js"></script>
    <script src="js/restrict.js"></script>
	<link rel="stylesheet" href="DataTables/datatables.css" />
    <script src="DataTables/datatables.js"></script>
	<script>
       $(document).ready(function () {
    $('table.display').DataTable(
      {
        ordering: false,
        info: false

      }
    );
} );
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
          createHeader('book', 'Cashier Report', '<i class="fas fa-clock"></i> &nbsp;Todays Report<?php echo Date() ?>');
        ?>
        <!-- header section end -->

        <!-- form content -->
        <div class="row" style="margin-top:45px">

          

          <div class="col col-md-12 table-responsive">
            <div id="print_content" class="table-responsive">
            	<table class="table table-bordered table-striped table-hover display" id="purchase_report_div">
                <?php
                require "php/report.php";
                showCashierSales("", "");
				
                ?>
            	</table>
            </div>
          </div>

          <div class="col-md-12 text-center">
            <button class="btn btn-primary" onclick="printReport('Purchase');">Print</button>
          </div>

        </div>
        <!-- form content end -->
        <hr style="border-top: 2px solid #ff5252;">
      </div>
    </div>
  </body>
</html>
