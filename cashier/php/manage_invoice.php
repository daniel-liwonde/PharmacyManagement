<?php
 require_once("functions.php");
  if(isset($_GET["action"]) && $_GET["action"] == "delete") {
    require "db_connection.php";
    $invoice_number = $_GET["invoice_number"];
    $query = "DELETE FROM invoices WHERE INVOICE_ID = $invoice_number";
    $result = mysqli_query($con, $query);
    if(!empty($result))
  		showInvoices();
  }

  if(isset($_GET["action"]) && $_GET["action"] == "refresh")
    showInvoices();

  if(isset($_GET["action"]) && $_GET["action"] == "search")
    searchInvoice(strtoupper($_GET["text"]), $_GET["tag"]);

  if(isset($_GET["action"]) && $_GET["action"] == "print_invoice")
    printInvoice($_GET["invoice_number"]);

  function showInvoices() {
    require "db_connection.php";
    if($con) {
      $seq_no = 0;
      $query = "SELECT * FROM invoices INNER JOIN customers ON invoices.CUSTOMER_ID = customers.ID";
      $result = mysqli_query($con, $query);
      while($row = mysqli_fetch_array($result)) {
        $seq_no++;
        showInvoiceRow($seq_no, $row);
      }
    }
  }
 
  function showInvoiceRow($seq_no, $row) {
    ?>
    <tr>
      <td><?php echo $seq_no; ?></td>
  
      <td><?php echo $row['NAME']; ?></td>
      <td><?php 
formatDate($row['INVOICE_DATE'] );
?></td>
      <td><?php echo number_format($row['TOTAL_AMOUNT']); ?></td>
      <td><?php echo $row['TOTAL_DISCOUNT']; ?></td>
      <td><?php echo number_format($row['NET_TOTAL']); ?></td>
      <td>
        <button class="btn btn-warning btn-sm" onclick="printInvoice(<?php echo $row['INVOICE_ID']; ?>);">
          <i class="fa fa-print"></i>
        </button>
        <button class="btn btn-danger btn-sm" onclick="deleteInvoice(<?php echo $row['INVOICE_ID']; ?>);">
          <i class="fa fa-trash"></i>
        </button>
        <a title="view details" class="btn btn-danger btn-sm set" href="view_details.php?invoice=<?php echo $row['INVOICE_ID']; ?>&menu=1">
          <i class="fa fa-list"></i>
  </a>
      </td>
    </tr>
    <?php
  }

  function searchInvoice($text, $column) {
    require "db_connection.php";
    if($con) {
      $seq_no = 0;
      if($column == 'INVOICE_ID')
        $query = "SELECT * FROM invoices INNER JOIN customers ON invoices.CUSTOMER_ID = customers.ID WHERE CAST(invoices.$column AS VARCHAR(9)) LIKE '%$text%'";
      else if($column == "INVOICE_DATE")
        $query = "SELECT * FROM invoices INNER JOIN customers ON invoices.CUSTOMER_ID = customers.ID WHERE invoices.$column = '$text'";
      else
        $query = "SELECT * FROM invoices INNER JOIN customers ON invoices.CUSTOMER_ID = customers.ID WHERE UPPER(customers.$column) LIKE '%$text%'";

      $result = mysqli_query($con, $query);
      while($row = mysqli_fetch_array($result)) {
        $seq_no++;
        showInvoiceRow($seq_no, $row);
      }
    }
  }

  function printInvoice($invoice_number) {
    require "db_connection.php";
    if($con) {
      $query = "SELECT * FROM sales INNER JOIN customers ON sales.CUSTOMER_ID = customers.ID WHERE sales.INVOICE_NUMBER = '$invoice_number'";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_array($result);
      $customer_name = $row['NAME'];
      $address = $row['GENDER'];
      $contact_number = $row['CONTACT_NUMBER'];
      $doctor_name = $row['VILLAGE'];
      $doctor_address = $row['DISTRICT'];

      $query = "SELECT * FROM invoices WHERE INVOICE_ID = $invoice_number";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_array($result);
      $invoice_date = $row['INVOICE_DATE'];
      $total_amount = $row['TOTAL_AMOUNT'];
      $total_discount = $row['TOTAL_DISCOUNT'];
      $net_total = $row['NET_TOTAL'];
    }

    ?>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
     <link rel="stylesheet" href="font6/css/all.css">
    <link rel="stylesheet" href="font6/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/sidenav.css">
    <link rel="stylesheet" href="css/home.css">
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10 h3" style="color: #ff5252;">Customer Invoice<span class="float-right">Invoice Number : <?php echo $invoice_number; ?></span></div>
    </div>
    <div class="row font-weight-bold">
      <div class="col-md-1"></div>
      <div class="col-md-10"><span class="h4 float-right">Invoice Date. : <?php echo formatDate($invoice_date);  ?></span></div>
    </div>
    <div class="row text-center">
      <hr class="col-md-10" style="padding: 0px; border-top: 2px solid  #ff5252;">
    </div>
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-4">
        <span class="h4">Customer Details : </span><br><br>
        <span class="font-weight-bold">Name : </span><?php echo $customer_name; ?><br>
        <span class="font-weight-bold">Gender : </span><?php echo $address; ?><br>
        <span class="font-weight-bold">Contact Number : </span><?php echo $contact_number; ?><br>
        <span class="font-weight-bold">Village : </span><?php echo $doctor_name; ?><br>
        <span class="font-weight-bold">District : </span><?php echo $doctor_address; ?><br>
      </div>
      <div class="col-md-3"></div>

      <?php

      $query = "SELECT * FROM admin_credentials";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_array($result);
     // $_name = $row['PHARMACY_NAME'];
      $p_name = $row['LNAME'];
      $p_email = $row['EMAIL'];
      $p_contact_number = $row['CONTACT_NUMBER'];
      ?>

      <div class="col-md-4">
        <span class="h4">Hospital Details : </span><br><br>
        <span class="font-weight-bold"><?php echo "Mulanje Mission"; ?></span><br>
        <span class="font-weight-bold"><?php echo "P/bag 20 Mulanje"; ?></span><br>
        <span class="font-weight-bold"><?php echo "info@mulanjehospital.com"; ?></span><br>
        <span class="font-weight-bold">Mob. No.: <?php echo "+265 123098"; ?></span>
      </div>
      <div class="col-md-1"></div>
    </div>
    <div class="row text-center">
      <hr class="col-md-10" style="padding: 0px; border-top: 2px solid  #ff5252;">
    </div>

    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10 table-responsive">
        <table class="table table-bordered table-striped table-hover" id="purchase_report_div">
          <thead>
            <tr>
              <th>SL</th>
              <th>Medicine Name</th>
              <th>Expiry Date</th>
              <th>Quantity</th>
              <th>Price</th>
              <th>Discount</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $seq_no = 0;
              $total = 0;
              $query = "SELECT * FROM sales WHERE INVOICE_NUMBER = $invoice_number";
              $result = mysqli_query($con, $query);
              while($row = mysqli_fetch_array($result)) {
                $seq_no++;
                ?>
                <tr>
                  <td><?php echo $seq_no; ?></td>
                  <td><?php echo $row['MEDICINE_NAME']; ?></td>
                  <td><?php echo $row['EXPIRY_DATE']; ?></td>
                  <td><?php echo $row['QUANTITY']; ?></td>
                  <td><?php echo $row['MRP']; ?></td>
                  <td><?php echo $row['INVOICE_NUMBER']."%"; ?></td>
                  <td><?php echo number_format($row['TOTAL']); ?></td>
                </tr>
                <?php
              }
            ?>
          </tbody>
          <tfoot class="font-weight-bold">
            <tr style="text-align: right; font-size: 18px;">
              <td colspan="6">&nbsp;Total Amount</td>
              <td><?php echo number_format($total_amount); ?></td>
            </tr>
            <tr style="text-align: right; font-size: 18px;">
              <td colspan="6">&nbsp;Total Discount</td>
              <td><?php echo number_format($total_discount); ?></td>
            </tr>
            <tr style="text-align: right; font-size: 22px;">
              <td colspan="6" style="color: green;">&nbsp;Net Amount</td>
              <td class="text-primary"><?php echo number_format($net_total); ?></td>
            </tr>
          </tfoot>
        </table>
      </div>
      <div class="col-md-1"></div>
    </div>
    <div class="row text-center">
      <hr class="col-md-10" style="padding: 0px; border-top: 2px solid  #ff5252;">
    </div>
    <?php
  }


  function showDetails($invoice_number) {
    require "db_connection.php";
    if($con) {
      $query = "SELECT * FROM sales INNER JOIN customers ON sales.CUSTOMER_ID = customers.ID WHERE sales.INVOICE_NUMBER = '$invoice_number'";
      $result = mysqli_query($con, $query) or die(mysqli_error($con));
      $row = mysqli_fetch_array($result);
      $customer_name = $row['NAME'];
      $address = $row['GENDER'];
      $contact_number = $row['CONTACT_NUMBER'];
      $doctor_name = $row['VILLAGE'];
      $doctor_address = $row['DISTRICT'];
      $query = "SELECT * FROM invoices WHERE INVOICE_ID = $invoice_number";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_array($result);
      $invoice_date = $row['INVOICE_DATE'];
      $total_amount = $row['TOTAL_AMOUNT'];
      $total_discount = $row['TOTAL_DISCOUNT'];
      $net_total = $row['NET_TOTAL'];
    }

    ?>
    <div class="container">
    <div class="row" >
      <div class="col-md-12 h2 text-center" style="color: #ff5252;">Customer Invoice</div>
    </div>
    <div class="row">
      <div class="col-md-12 text-center">Invoice Number : <?php echo $invoice_number; ?></div>
    </div>
    <div class="row font-weight-bold">
      <div class="col-md-12 text-center"><span class="h5">Invoice Date. : <?php echo formatDate($invoice_date);  ?></span></div>
    </div>
    <div class="row text-center">
      <hr class="col-md-10" style="padding: 0px; border-top: 2px solid  #ff5252;">
    </div>
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-4">
        <span class="h4">Customer Details : </span><br><br>
        <span class="font-weight-bold">Name : </span><?php echo $customer_name; ?><br>
        <span class="font-weight-bold">Gender : </span><?php echo $address; ?><br>
        <span class="font-weight-bold">Contact Number : </span><?php echo $contact_number; ?><br>
        <span class="font-weight-bold">Village : </span><?php echo $doctor_name; ?><br>
        <span class="font-weight-bold">District : </span><?php echo $doctor_address; ?><br>
      </div>
      <div class="col-md-3"></div>

      <?php

      $query = "SELECT * FROM admin_credentials  INNER JOIN sales ON admin_credentials.USER_ID=sales.CASHIER_ID";
      $result = mysqli_query($con, $query) or die(mysqli_error($con));
      $row = mysqli_fetch_array($result);
     // $_name = $row['PHARMACY_NAME'];
     $cashier_fname = $row['FNAME'];
      $cashier_lname = $row['LNAME'];
      $section = ($row['SECTION']==1)? "Private":"General";
      $p_contact_number = $row['CONTACT_NUMBER'];
      ?>

      <div class="col-md-4">
        <span class="h4">Cashier Details: </span><br><br>
        <span class="font-weight-bold">Name:      <?php echo $cashier_lname." ". $cashier_fname; ?></span><br>
        <span class="font-weight-bold">Section:  <?php echo $section ?></span><br>
        <span class="font-weight-bold">Phone:    <?php echo $p_contact_number?></span><br>
      </div>
      <div class="col-md-1"></div>
    </div>
    <div class="row text-center">
      <hr class="col-md-10" style="padding: 0px; border-top: 2px solid  #ff5252;">
    </div>
     
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10 table-responsive">
        <table class="table table-bordered table-striped table-hover" id="purchase_report_div">
          <thead>
            <tr>
              <th>SL</th>
              <th>Medicine Name</th>
              <th>Expiry Date</th>
              <th>Quantity</th>
              <th>Price</th>
               <th>Total Amount</th>
              <th>Discount</th>
              <th>Net Total</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $seq_no = 0;
              $total = 0;
              $query = "SELECT * FROM sales WHERE INVOICE_NUMBER = $invoice_number";
              $result = mysqli_query($con, $query);
              while($row = mysqli_fetch_array($result)) {
                $seq_no++;
                ?>
                <tr>
                  <td><?php echo $seq_no; ?></td>
                  <td><?php echo $row['MEDICINE_NAME']; ?></td>
                  <td class="text-center"><?php echo $row['EXPIRY_DATE']? $row['EXPIRY_DATE']:"N/A"; ?></td>
                  <td><?php echo $row['QUANTITY']; ?></td>
                  <td><?php echo $row['MRP']; ?></td>
                  <td><?php echo number_format($total_amount); ?></td>
                  <td><?php echo $row['INVOICE_NUMBER']."%"; ?></td>
                  <td><?php echo number_format($row['TOTAL']); ?></td>
                </tr>
                <?php
              }
            ?>
          </tbody>
          <tfoot class="font-weight-bold">
            <tr style="text-align: right; font-size: 18px;">
              <td colspan="7">&nbsp;Total Amount</td>
              <td><?php echo number_format($total_amount); ?></td>
            </tr>
            <tr style="text-align: right; font-size: 18px;">
              <td colspan="7">&nbsp;Total Discount</td>
              <td><?php echo number_format($total_discount); ?></td>
            </tr>
            <tr style="text-align: right; font-size: 22px;">
              <td colspan="7" style="color: green;">&nbsp;Net Amount</td>
              <td class="text-primary"><?php echo number_format($net_total); ?></td>
            </tr>
          </tfoot>
        </table>
      </div>
      <div class="col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-12 mb-2" > <a style="margin-left:8.6%" class="btn btn-info " href="export_invoice.php?export=<?php echo $invoice_number; ?>&menu=1">Export to Excel&nbsp;<i class="fas fa-file-export"></i></a></div>
    </div>

    <?php
  }
function export($invoice_number) {
  ?>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <?php
    require "db_connection.php";
    //require_once"xlsxwriter.class";
    if($con) {
      $query = "SELECT * FROM sales INNER JOIN customers ON sales.CUSTOMER_ID = customers.ID WHERE sales.INVOICE_NUMBER = '$invoice_number'";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_array($result);
      $customer_name = $row['NAME'];
      $address = $row['GENDER'];
      $contact_number = $row['CONTACT_NUMBER'];
      $doctor_name = $row['VILLAGE'];
      $doctor_address = $row['DISTRICT'];

      $query = "SELECT * FROM invoices WHERE INVOICE_ID = $invoice_number";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_array($result);
      $invoice_date = $row['INVOICE_DATE'];
      $total_amount = $row['TOTAL_AMOUNT'];
      $total_discount = $row['TOTAL_DISCOUNT'];
      $net_total = $row['NET_TOTAL'];
    }

    ?>
    <div class="container">
    <div class="row" >
      <div class="col-md-12 h2 text-center" style="color: #ff5252;">Customer Invoice</div>
    </div>
    <div class="row">
      <div class="col-md-12 text-center">Invoice Number : <?php echo $invoice_number; ?></div>
    </div>
    <div class="row font-weight-bold">
      <div class="col-md-12 text-center"><span class="h5">Invoice Date. : <?php echo formatDate($invoice_date);  ?></span></div>
    </div>
    <div class="row text-center">
      <hr class="col-md-10" style="padding: 0px; border-top: 2px solid  #ff5252;">
    </div>
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-4">
        <span class="h4">Customer Details : </span><br><br>
        <span class="font-weight-bold">Name : </span><?php echo $customer_name; ?><br>
        <span class="font-weight-bold">Gender : </span><?php echo $address; ?><br>
        <span class="font-weight-bold">Contact Number : </span><?php echo $contact_number; ?><br>
        <span class="font-weight-bold">Village : </span><?php echo $doctor_name; ?><br>
        <span class="font-weight-bold">District : </span><?php echo $doctor_address; ?><br>
      </div>
      <div class="col-md-3"></div>

      <?php

      $query = "SELECT * FROM admin_credentials  INNER JOIN sales ON admin_credentials.USER_ID=sales.CASHIER_ID";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_array($result);
     // $_name = $row['PHARMACY_NAME'];
     $cashier_fname = $row['FNAME'];
      $cashier_lname = $row['LNAME'];
      $section = ($row['SECTION']==1)? "Private":"General";
      $p_contact_number = $row['CONTACT_NUMBER'];
      ?>

      <div class="col-md-4">
        <span class="h4">Cashier Details: </span><br><br>
        <span class="font-weight-bold">Name:      <?php echo $cashier_lname." ". $cashier_fname; ?></span><br>
        <span class="font-weight-bold">Section:  <?php echo $section ?></span><br>
        <span class="font-weight-bold">Phone:    <?php echo $p_contact_number?></span><br>
      </div>
      <div class="col-md-1"></div>
    </div>
    <div class="row text-center">
      <hr class="col-md-10" style="padding: 0px; border-top: 2px solid  #ff5252;">
    </div>
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10 table-responsive">
        <table class="table table-bordered table-striped table-hover" id="purchase_report_div" border="1" borderColor="#ccc">
          <thead>
            <tr>
              <th>SL</th>
              <th>Medicine Name</th>
              <th>Expiry Date</th>
              <th>Quantity</th>
              <th>Price</th>
               <th>Total Amount</th>
              <th>Discount</th>
              <th>Net Total</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $seq_no = 0;
              $total = 0;
              $query = "SELECT * FROM sales WHERE INVOICE_NUMBER = $invoice_number";
              $result = mysqli_query($con, $query);
              while($row = mysqli_fetch_array($result)) {
                $seq_no++;
                ?>
                <tr>
                  <td><?php echo $seq_no; ?></td>
                  <td><?php echo $row['MEDICINE_NAME']; ?></td>
                  <td class="text-center"><?php echo $row['EXPIRY_DATE']? $row['EXPIRY_DATE']:"N/A"; ?></td>
                  <td><?php echo $row['QUANTITY']; ?></td>
                  <td><?php echo $row['MRP']; ?></td>
                  <td><?php echo number_format($total_amount); ?></td>
                  <td><?php echo $row['INVOICE_NUMBER']."%"; ?></td>
                  <td><?php echo number_format($row['TOTAL']); ?></td>
                </tr>
                <?php
              }
            ?>
          </tbody>
          <tfoot class="font-weight-bold">
            <tr style="text-align: right; font-size: 18px;">
              <td colspan="7">&nbsp;Total Amount</td>
              <td><?php echo number_format($total_amount); ?></td>
            </tr>
            <tr style="text-align: right; font-size: 18px;">
              <td colspan="7">&nbsp;Total Discount</td>
              <td><?php echo number_format($total_discount); ?></td>
            </tr>
            <tr style="text-align: right; font-size: 22px;">
              <td colspan="7" style="color: green;">&nbsp;Net Amount</td>
              <td class="text-primary"><?php echo number_format($net_total); ?></td>
            </tr>
          </tfoot>
        </table>
      </div>
      <div class="col-md-1"></div>
    </div>
    <div class="row text-center">
    </div>

    <?php
  }
?>
</div>
