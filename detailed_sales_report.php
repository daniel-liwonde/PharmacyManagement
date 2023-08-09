<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Detailed Sales Report</title>
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
    <script src="js/report2.js"></script>
    <script src="js/restrict.js"></script>
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
          createHeader('folder-open', 'Sales Report', '<i class="fa fa-coins"></i>&nbsp;Product Sales Report');
        ?>
        <!-- header section end -->

        <!-- form content -->
        <div class="row" style="margin-top:45px">
          <div class="col-md-12 form-group form-inline">
            <select class="form-control" id="p_name" required onchange="showProductReport('pSales');">
                <option value="ALL">All Products</option>
                <?php
                include("php/db_connection.php");
                $prod=mysqli_query($con,"SELECT * FROM medicines_stock") or die(mysqli_error($con));
                while($getProd=mysqli_fetch_assoc($prod))
                {
                    ?>
                  <option value="<?php echo $getProd['NAME']?>"><?php echo $getProd['NAME']."-".$getProd['BATCH_ID'] ?></option>
                    <?php
                }
                ?>
            </select>
            &nbsp;
            <select class="form-control" id="p_section" onchange="showProductReport('pSales');">
                
              
                <option value="1">General</option>
                <option value="2">Private</option>  
                <option value="3">Both sections</option>   
            </select>
            &nbsp;From:&nbsp;
             <input type="date" class="form-control" id="start_date" onchange="showProductReport('pSales');" >
            &nbsp;
             &nbsp;To:&nbsp;
            <input type="date" class="form-control" id="end_date" onchange="showProductReport('pSales');">
            &nbsp;
           

            <button class="btn btn-success set" onclick="location.reload();"><i class="fa fa-refresh"></i></button>
          </div>
          <div class="col col-md-12">
            <hr class="col-md-12" style="padding: 0px; border-top: 2px solid  #02b6ff;">
          </div>

          <div class="col col-md-12 table-responsive">
            <div id="print_content" class="table-responsive">
            	<table class="table table-bordered table-striped table-hover" id="pSales_report_div">
            	</table>
            </div>
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