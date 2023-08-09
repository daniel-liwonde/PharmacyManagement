<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Manage Supplier</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script src="bootstrap/js/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="font6/css/all.css">
    <link rel="shortcut icon" href="" type="image/x-icon">
    <link rel="stylesheet" href="font6/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/sidenav.css">
    <link rel="stylesheet" href="css/home.css">
    <script src="js/manage_supplier.js"></script>
    <script src="js/validateForm.js"></script>
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
          createHeader('people-group', 'Suppliers', '<i class="fa fa-tools"></i> &nbsp;Manage Supplier');
        ?>
        <!-- header section end -->

        <!-- form content -->
        <div class="row" style="margin-top:45px">

          <div class="col-md-12 form-group form-inline">
            <label class="font-weight-bold" for="">Search :&emsp;</label>
            <input type="text" class="form-control" id="" placeholder="Search Supplier" onkeyup="searchSupplier(this.value);">
          </div>

          <div class="col col-md-12">
            <hr class="col-md-12" style="padding: 0px; border-top: 2px solid  #02b6ff;">
          </div>

          <div class="col col-md-12 table-responsive">
            <div class="table-responsive">
            	<table class="table table-bordered table-striped table-hover">
            		<thead>
            			<tr>
                    <th style="width: 5%;">SL</th>
            				<th style="width: 20%;">Name</th>
                    <th style="width: 15%;">Email</th>
                    <th style="width: 15%;">Contact Number</th>
                    <th style="width: 20%;">Address</th>
                    <th style="width: 15%;">Action</th>
            			</tr>
            		</thead>
                <tbody id="suppliers_div">
                  <?php
                    require 'php/manage_supplier.php';
                    showSuppliers(0);
                  ?>
            		</tbody>
            	</table>
            </div>
          </div>

        </div>
        <!-- form content end -->
        <hr style="border-top: 2px solid #ff5252;">
      </div>
    </div>
  </body>
</html>
