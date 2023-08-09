<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Add New Customer</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script src="bootstrap/js/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="font6/css/all.css">
    <link rel="shortcut icon" href="" type="image/x-icon">
    <link rel="stylesheet" href="font6/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/sidenav.css">
    <link rel="stylesheet" href="css/home.css">
    <script src="js/validate_Customer.js"></script>
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
          createHeader('hand-holding-medical', 'Add Customer', '<i class="fa fa-circle-plus"></i>&nbsp;Add New Customer');
          // header section end
        ?>
        <div class="row" style="margin-top:45px">
          <div class="row col col-md-6">
            <?php
              // form content
              require "sections/add_new_customer.html";
            ?>
          </div>
        </div>
        <hr style="border-top: 2px solid #ff5252;">
      </div>
    </div>
  </body>
</html>
