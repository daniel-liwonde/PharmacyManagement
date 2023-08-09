<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Purchase details</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script src="bootstrap/js/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="font6/css/all.css">
    <link rel="shortcut icon" href="images/icon.svg" type="image/x-icon">
    <link rel="stylesheet" href="font6/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/sidenav.css">
    <link rel="stylesheet" href="css/home.css">
       <link rel="stylesheet" href="css/style.css">
    <script src="js/manage_invoice.js"></script>
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
          createHeader('book', 'Reports', '<i class="fa fa-list"></i>&nbsp;Purchase Details');
        ?>
        <!-- header section end -->

        <!-- form content -->
        <div class="row" style="margin-top:45px">

          <div class="col col-md-12 col-lg-12">
           <!-- <hr class="col-md-12" style="padding: 0px; border-top: 2px solid  #02b6ff;">-->
          
                  <?php
                    require 'php/manage_purchase.php';
                    showPurchaseDetails($_GET['invoice']);
                   
                  ?>
				  </div>
        </div>
        <!-- form content end -->
        <hr style="border-top: 2px solid #ff5252;">
      </div>
    </div>
  </body>
</html>
