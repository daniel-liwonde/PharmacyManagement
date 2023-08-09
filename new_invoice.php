<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>New Invoice</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script src="bootstrap/js/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="font6/css/all.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="images/icon.svg" type="image/x-icon">
    <link rel="stylesheet" href="font6/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/sidenav.css">
    <link rel="stylesheet" href="css/home.css">
    <script src="js/suggestions.js"></script>
    <script src="js/add_new_invoice.js"></script>
    <script src="js/manage_invoice.js"></script>
    <script src="js/validate_Customer.js"></script>
    <script src="js/restrict.js"></script>
<script src="js/jquery-ui/jquery-ui.js"></script>
    <script src="js/handleCustomer.js"></script>
    <link rel="stylesheet" href="js/jquery-ui/jquery-ui.css">
<script src="js/jquery-ui/external/jquery/jquery.js"></script>
<script src="js/jquery-ui/jquery-ui.js"></script>
<script>
  $(function() {
    // Initialize draggable on your modal element
    $("#add_new_customer_model").draggable();
  });
</script>
  </head>
  <body>
    <div id="add_new_customer_model" style="height:400px">
      <div class="modal-dialog">
      	<div class="modal-content" style="overflow:auto">
      		<div class="modal-header" style="background-color: #ff5252; color: white">
            <div class="font-weight-bold">Add New Customer</div>
      			<button class="close" style="outline: none;" onclick="document.getElementById('add_new_customer_model').style.display = 'none';"><i class="fa fa-close"></i></button>
      		</div>
      		<div class="modal-body">
            <?php
            session_start();
              include('sections/add_new_customer.html');
            ?>
      		</div>
      	</div>
      </div>
    </div>
    <!-- including side navigations -->
    <?php include("sections/sidenav.php"); ?>

    <div class="container-fluid" style="width:82%; margin-left:18%">
      <div class="container">

        <!-- header section -->
        <?php
          require "php/header.php";
          createHeader('clipboard', 'Invoice', '<i class="fa fa-circle-plus"></i> &nbsp;New Invoice');
          function getPaymentMethod()
          {
            require "php/db_connection.php";
            $data=mysqli_query($con,"SELECT * FROM payment_methods"); 
            while($r=mysqli_fetch_assoc($data))
            {
              $method=$r['payment_name'];
              echo "<option value='{$r['id']}'>{$method}</option>";
            }
          }
        ?>
        <!-- header section end -->

        <!-- form content -->
        <div class="row" style="margin-top:45px">
          <!-- customer details content -->
          <div class="row col col-md-12">
            <div class="col col-md-3 form-group">
              <label class="font-weight-bold" for="customers_name">Customer Name :</label>
              <input id="customers_name" type="text" class="form-control" placeholder="Customer Name" name="customers_name" onkeyup="showSuggestions(this.value, 'customer');">
              <code class="text-danger small font-weight-bold float-right" id="customer_name_error" style="display: none;"></code>
              <div id="customer_suggestions" class="list-group position-fixed" style="z-index: 1; width: 18.30%; overflow: auto; max-height: 200px;"></div>
            </div>
            <div class="col col-md-3 form-group">
              <label class="font-weight-bold" for="customers_address">Village :</label>
              <input id="customers_address" type="text" class="form-control" name="customers_address" placeholder="Address" disabled>
            </div>
            <div class="col col-md-2 form-group">
              <label class="font-weight-bold" for="invoice_number">Invoice No:</label>
              <input id="invoice_number" type="text" class="form-control" name="invoice_number" placeholder="Invoice Number" disabled>
            </div>
            <div class="col col-md-2 form-group">
              <label class="font-weight-bold" for="">Payment Type :</label>
              <select id="payment_type" class="form-control">
              	<?php getPaymentMethod() ?>
              </select>
            </div>
            <div class="col col-md-2 form-group">
               <label class="font-weight-bold" for="">Date:</label>
              <input type="date" class="datepicker form-control hasDatepicker" id="invoice_date" value='<?php echo date('Y-m-d'); ?>' onblur="checkDate(this.value, 'date_error');">
              <code class="text-danger small font-weight-bold float-right" id="date_error" style="display: none;"></code>
            </div>
          </div>
          <!-- customer details content end -->

          <!-- new user button -->
          <div class="row col col-md-12">
            <div class="col col-md-2 form-group">
              <button class="btn btn-primary form-control" onclick="document.getElementById('add_new_customer_model').style.display = 'block';">New Customer</button>
            </div>
            <div class="col col-md-1 form-group"></div>
            <div class="col col-md-2 form-group">
              <label class="font-weight-bold" for="customers_contact_number">Contact No:</label>
              <input id="customers_contact_number" type="number" class="form-control" name="customers_contact_number" placeholder="Contact Number" disabled>
            </div>
          </div>
          <!-- closing new user button -->

          <div class="col col-md-12">
            <hr class="col-md-12" style="padding: 0px; border-top: 3px solid  #02b6ff;">
          </div>

          <!-- add medicines -->
          <div class="row col col-md-12">
            <div class="row col col-md-12 font-weight-bold">
              <div class="col col-md-2">Medicine Name</div>
              <div class="col col-md-1">Batch</div>
              <div class="col col-md-1">Ava.Qty.</div>
              <div class="col col-md-1 text-center">Expiry</div>
              <div class="col col-md-1">Qty.</div>
              <div class="col col-md-1">Sale.P</div>
              <div class="col col-md-1 text-left">Disco(%)</div>
              <div class="col col-md-2 text-center">Total</div>
              <div class="col col-md-2">Action</div>
            </div>
          </div>
          <div class="col col-md-12">
            <hr class="col-md-12" style="padding: 0px; border-top: 2px solid  #02b6ff;">
          </div>

          <div class="row col col-md-12 " id="invoice_medicine_list_div">
            <script> addRow(); getInvoiceNumber(); </script>
          </div>
          <!-- end medicines -->

          <div class="row col col-md-12">
            <div class="col col-md-6 form-group"></div>
            <div class="col col-md-2 form-group float-right">
              <label class="font-weight-bold" for="">Total Amount:</label>
              <input type="text" class="form-control" value="0" id="total_amount" disabled>
            </div>
            <div class="col col-md-2 form-group float-right">
              <label class="font-weight-bold" for="">Total Discount :</label>
              <input type="text" class="form-control" value="0" id="total_discount" disabled>
            </div>
            <div class="col col-md-2 form-group float-right">
              <label class="font-weight-bold" for="">Net Total :</label>
              <input type="text" class="form-control" value="0" id="net_total" disabled>
            </div>
          </div>

          <div class="col col-md-12">
            <hr class="col-md-12" style="padding: 0px;">
          </div>

          <div class="row col col-md-12">
            <div id="save_button" class="col col-md-2 form-group float-right">
              <label class="font-weight-bold" for=""></label>
              <button class="btn btn-success  form-control font-weight-bold" onclick="addInvoice(); pull-left"><i class="fa fa-save fa-lg"></i>&nbsp;&nbsp;Save Invoice</button>
            </div>
            <div id="new_invoice_button" class="col col-md-2 form-group float-right"  style="display: none;">
              <label class="font-weight-bold" for=""></label>
              <button class="btn btn-primary form-control font-weight-bold" onclick="location.reload();;">New Invoice</button>
            </div>
            <div id="print_button" class="col col-md-2 form-group float-right" style="display: none;">
              <label class="font-weight-bold" for=""></label>
              <button class="btn btn-warning form-control font-weight-bold" onclick="printInvoice(document.getElementById('invoice_number').value);">Print</button>
            </div>
            <div class="col col-md-4 form-group"></div>
            <div class="col col-md-2 form-group float-right">
              <label class="font-weight-bold" for="">Paid Amount :</label>
              <input type="text" class="form-control" name="total_discount" onkeyup="getChange(this.value);">
            </div>
            <div class="col col-md-2 form-group float-right">
              <label class="font-weight-bold" for="">Change :</label>
              <input type="text" class="form-control" id="change_amt" disabled>
            </div>
          </div>

          <div id="invoice_acknowledgement" class="col-md-12 h5 text-success font-weight-bold text-center" style="font-family: sans-serif;"></div>

        </div>
        <!-- form content end -->
        <hr style="border-top: 2px solid #ff5252;">
      </div>
    </div>
  </body>
</html>