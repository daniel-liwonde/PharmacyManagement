<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Invoices</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script src="bootstrap/js/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="font6/css/all.css">
    <link rel="shortcut icon" href="images/icon.svg" type="image/x-icon">
    <link rel="stylesheet" href="font6/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/sidenav.css">
    <link rel="stylesheet" href="css/home.css">
       <link rel="stylesheet" href="css/style.css">
       <link rel="stylesheet" href="DataTables/datatables.css" />
    <script src="DataTables/datatables.js"></script>
    <script src="js/manage_invoice.js"></script>
    <script src="js/restrict.js"></script>
    <script>
       $(document).ready(function () {
    $('table.display').DataTable(
      {
        ordering: false,
        info: false

      }
    );
} );
      </script>
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
          createHeader('address-book', 'Invoices', '<i class="fa fa-gears"></i>&nbsp;Manage Invoices');
        ?>
        <!-- header section end -->

        <!-- form content -->
      
           <!-- form content -->
        <div class="row" style="margin-top:45px">

          <div class="col-md-12 form-group form-inline">
            <label class="font-weight-bold" for="">Search :&emsp;</label>
            <input type="number" class="form-control" id="by_invoice_number" placeholder="By Invoice Number" onkeyup="searchInvoice(this.value, 'INVOICE_ID');">
            &emsp;<input type="text" class="form-control" id="by_customer_name" placeholder="By Customer Name" onkeyup="searchInvoice(this.value, 'NAME');">
            &emsp;<label class="font-weight-bold" for="">By Invoice Date :&emsp;</label>
            <input type="date" class="form-control" id="by_date" onchange="searchInvoice(this.value, 'INVOICE_DATE');">
            &emsp;<button class="btn btn-success set font-weight-bold" onclick="refresh();"><i class="fa fa-refresh"></i></button>
          </div>

          <div class="col col-md-12">
            <hr class="col-md-12" style="padding: 0px; border-top: 2px solid  #02b6ff;">
          </div>


          <div class="col col-md-12 table-responsive">
            <div class="table-responsive">
            	<table class="table table-bordered table-striped table-hover">
            		<thead>
            			<tr>
            				<th>SL.</th>
            				<th>Customer Name</th>
            				<th>Date</th>
                    <th>Total Amount</th>
                    <th>Total Discount</th>
                    <th>Net Total</th>
                    <th>Action</th>
            			</tr>
            		</thead>
                <tbody id="invoices_div">
                  <?php
                    require 'php/manage_invoice.php';
                    showInvoices();
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
