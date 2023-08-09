<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Manage Customer</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script src="bootstrap/js/jquery.min.js"></script>
    <script src="js/jquery3.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="font6/css/all.css">
    <link rel="shortcut icon" href="" type="image/x-icon">
    <link rel="stylesheet" href="font6/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/sidenav.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="DataTables/datatables.css" />
    <script src="DataTables/datatables.js"></script>
    <script src="js/manageCustomer.js"></script>
    <script src="js/handleCustomer.js"></script>
    <script>
      $(document).ready( function () {
    $('#myTable').DataTable();
} );
      </script>
  </head>
  <body style="max-height: 100%;">
    <!-- including side navigations -->
    <?php include("sections/sidenav.php"); ?>

    <div class="container-fluid" style="width:82%; margin-left:18%">
      <div class="container">

        <!-- header section -->
        <?php
          require "php/header.php";
          createHeader('user-group', 'Manage Customer', '<i class="fa fa-user-gear"></i>&nbsp;Manage Existing Customer');
        ?>
        <!-- header section end -->

        <!-- form content -->
        <div class="row"style="margin-top: 45px">

          <div class="col-md-12 form-group form-inline">
            <label class="font-weight-bold" for="">Search :&emsp;</label>
            <input type="text" class="form-control" id="" placeholder="Search Customer" onkeyup="searchCustomer(this.value);">
          </div>

          <div class="col col-md-12">
            <hr class="col-md-12" style="padding: 0px; border-top: 2px solid  #02b6ff;">
          </div>

          <div class="col col-md-12 table-responsive">
            <div class="table-responsive">
            	<table class="table table-bordered table-striped table-hover display" id="myTable">
            		<thead>
            			<tr>
            				<th style="width: 2%;">No</th>
            				<th style="width: 13%;">Customer Name</th>
                    <th style="width: 13%;">Contact Number</th>
                    <th style="width: 8%;">Gender</th>
                    <th style="width: 10%;">Village</th>
                    <th style="width: 14%;">B.Date</th>
                    <th style="width: 14%;">T/A</th>
                        <th style="width:17%;">District</th>
                    <th style="width:25%;">Action</th>
            			</tr>
            		</thead>
            		<tbody id="customers_div">
                  <?php
                    require 'php/manage_customer.php';
                    showCustomers(0);
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
