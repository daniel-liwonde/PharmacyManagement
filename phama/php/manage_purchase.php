<?php
 require "functions.php";
  require "db_connection.php";

  if($con) {
    if(isset($_GET["action"]) && $_GET["action"] == "delete") {
      $id = $_GET["id"];
       mysqli_query($con,"DELETE FROM medicines_stock WHERE INVOICE_NUMBER = $id");
      $query = "DELETE FROM purchases WHERE INVOICE_NUMBER = $id";
      $result = mysqli_query($con, $query);
      if(!empty($result))
    		showPurchases(0);
    }

    if(isset($_GET["action"]) && $_GET["action"] == "edit") {
      $id = $_GET["id"];
      showPurchases($id);
    }

    if(isset($_GET["action"]) && $_GET["action"] == "update") {
      $id = $_GET["id"];
      $suppliers_name = ucwords($_GET["suppliers_name"]);
      $invoice_date = $_GET["invoice_date"];
      $grand_total = $_GET["grand_total"];
      $payment_status = $_GET["payment_status"];
      updatePurchase($id, $suppliers_name, $invoice_date, $grand_total, $payment_status);
    }

    if(isset($_GET["action"]) && $_GET["action"] == "cancel")
      showPurchases(0);

    if(isset($_GET["action"]) && $_GET["action"] == "search")
      searchPurchase(strtoupper($_GET["text"]), $_GET["tag"]);
  }

  function showPurchases($id) {
    require "db_connection.php";
    if($con) {
      $seq_no = 0;
      $query = "SELECT * FROM purchases";
      $result = mysqli_query($con, $query);
      while($row = mysqli_fetch_array($result)) {
        $seq_no++;
        if($row['VOUCHER_NUMBER'] == $id)
          showEditOptionsRow($seq_no, $row);
        else
          showPurchaseRow($seq_no, $row);
      }
    }
  }

  function showPurchaseRow($seq_no, $row) {
    ?>
    <tr>
      <td><?php echo $seq_no; ?></td>
      <td><?php echo $row['SUPPLIER_NAME'] ?></td>
      <td><?php echo $row['INVOICE_NUMBER']; ?></td>
      <td><?php formatDate($row['PURCHASE_DATE']); ?></td>
      <td><?php echo number_format($row['TOTAL_AMOUNT']); ?></td>
      <td><?php echo $row['PAYMENT_STATUS']; ?></td>
      <td>
        <!--
        <button class="btn btn-warning btn-sm" onclick="printPurchase(<?php echo $row['VOUCHER_NUMBER']; ?>);">
          <i class="fa fa-fax"></i>
        </button>
      -->
        <button href="" class="btn btn-info btn-sm" onclick="editPurchase(<?php echo $row['VOUCHER_NUMBER']; ?>);">
          <i class="fa fa-pencil"></i>
        </button>
        <button class="btn btn-danger btn-sm" onclick="deletePurchase(<?php echo $row['INVOICE_NUMBER']; ?>);">
          <i class="fa fa-trash"></i>
        </button>
         <a title="view details" class="btn btn-danger btn-sm set" href="purchase_details.php?invoice=<?php echo $row['INVOICE_NUMBER']; ?>&menu=1">
          <i class="fa fa-list"></i>
  </a>
      </td>
    </tr>
    <?php
  }

function showEditOptionsRow($seq_no, $row) {
  ?>
  <tr>
    <td><?php echo $seq_no; ?></td>
    <td><?php echo $row['VOUCHER_NUMBER'] ?></td>
    <td>
      <input id="suppliers_name" type="text" class="form-control" value="<?php echo $row['SUPPLIER_NAME']; ?>" placeholder="Supplier Name" name="suppliers_name" onkeyup="showSuggestions(this.value, 'supplier');" disabled>
      <!--<code class="text-danger small font-weight-bold float-right" id="supplier_name_error" style="display: none;"></code>
      <div id="supplier_suggestions" class="list-group position-fixed" style="z-index: 1; width: 25.10%; overflow: auto; max-height: 200px;"></div>-->
    </td>
    <td>
      <input type="number" class="form-control" value="<?php echo $row['INVOICE_NUMBER']; ?>" id="invoice_number" disabled>
    </td>
    <td>
      <input type="date" class="datepicker form-control hasDatepicker" id="invoice_date" name="invoice_date" value='<?php echo $row['PURCHASE_DATE'] ?>' onblur="checkDate(this.value, 'date_error');">
      <code class="text-danger small font-weight-bold float-right" id="date_error" style="display: none;"></code>
    </td>
    <td><input type="text" class="form-control" value="<?php echo $row['TOTAL_AMOUNT']; ?>" id="grand_total" name="grand_total" disabled></td>
    <td>
      <select id="payment_status" class="form-control">
        <option value="DUE" <?php if($row['PAYMENT_STATUS'] == "DUE") echo "selected" ?>>DUE</option>
        <option value="PAID" <?php if($row['PAYMENT_STATUS'] == "PAID") echo "selected" ?>>PAID</option>
      </select>
    </td>
    <td>
      <button href="" class="btn btn-success btn-sm" onclick="updatePurchase(<?php echo $row['VOUCHER_NUMBER']; ?>);">
        <i class="fa fa-edit"></i>
      </button>
      <button class="btn btn-danger btn-sm" onclick="cancel();">
        <i class="fa fa-close"></i>
      </button>
    </td>
  </tr>
  <?php
}

function updatePurchase($id, $suppliers_name, $invoice_date, $grand_total, $payment_status) {
  require "db_connection.php";
  //echo $payment_status;
  $query = "UPDATE purchases SET SUPPLIER_NAME = '$suppliers_name', PURCHASE_DATE = '$invoice_date', TOTAL_AMOUNT = $grand_total, PAYMENT_STATUS = '$payment_status' WHERE VOUCHER_NUMBER = $id";
  $result = mysqli_query($con, $query);
  if(!empty($result))
    showPurchases(0);
}

function searchPurchase($text, $column) {
  require "db_connection.php";
  if($con) {
    $seq_no = 0;
    $query = "SELECT * FROM purchases WHERE $column LIKE '%$text%'";
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_array($result)) {
      $seq_no++;
      showPurchaseRow($seq_no, $row);
    }
  }
}
function showPurchaseDetails($invoice_number) {
    require "db_connection.php";
    if($con) {
      $query = "SELECT * FROM purchases INNER JOIN medicines_stock ON purchases.INVOICE_NUMBER = medicines_stock.INVOICE_NUMBER WHERE medicines_stock.INVOICE_NUMBER = '$invoice_number'";
      $result = mysqli_query($con, $query) or die(mysqli_error($con));
      $row = mysqli_fetch_array($result);
      $supplier_name = $row['SUPPLIER_NAME'];
	   $querysup = mysqli_query($con,"SELECT * FROM suppliers WHERE NAME='$supplier_name'")or die(mysqli_error($con));
       $sup_row = mysqli_fetch_array($querysup);
	        
      $contact_number = $sup_row['CONTACT_NUMBER'];
	  $email=$sup_row['EMAIL'];
      $invoice_date = $row['PURCHASE_DATE'];
      $total_amount = $row['TOTAL_AMOUNT'];
      $payment_status = $row['PAYMENT_STATUS'];
    }

    ?>
    <div class="container">
    <div class="row" >
      <div class="col-md-12 h2 text-center" style="color: #ff5252;">Purchase details</div>
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
        <span class="h4">Supplier Details : </span><br><br>
        <span class="font-weight-bold">Name : </span><?php echo $supplier_name; ?><br>
        <span class="font-weight-bold">Contact: </span><?php echo $contact_number; ?><br>
        <span class="font-weight-bold">Email : </span><?php echo $email ?><br>
       
      </div>
      <div class="col-md-3"></div>

      <?php

      $query = "SELECT * FROM admin_credentials  INNER JOIN purchases ON admin_credentials.USER_ID=purchases.PURCHASE_BY";
      $result = mysqli_query($con, $query) or die(mysqli_error($con));
      $row_facilitator = mysqli_fetch_array($result);
     // $_name = $row['PHARMACY_NAME'];
	 
     $cashier_fname =  $row_facilitator['FNAME'];
      $cashier_lname =  $row_facilitator['LNAME'];
      ?>

      <div class="col-md-4">
        <span class="h4">Purchase done by: </span><br><br>
        <span class="font-weight-bold">Name:      <?php echo ($row_facilitator)?$cashier_lname." ". $cashier_fname :"Unknown"; ?></span><br>
        
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
              <th>Product Name</th>
              <th>Expiry Date</th>
              <th>Quantity</th>
              <th>Cost</th>
               <th width="150">Total</th>
             
			  
            </tr>
          </thead>
          <tbody>
            <?php
              $seq_no = 0;
              $total = 0;
              $query = "SELECT * FROM medicines_stock WHERE INVOICE_NUMBER = $invoice_number";
              $result = mysqli_query($con, $query);
              while($row = mysqli_fetch_array($result)) {
                $seq_no++;
                ?>
                <tr>
                  <td><?php echo $seq_no; ?></td>
                  <td><?php echo $row['NAME']; ?></td>
                  <td class="text-center"><?php echo $row['EXPIRY_DATE']? $row['EXPIRY_DATE']:"N/A"; ?></td>
                  <td><?php echo $row['QUANTITY']; ?></td>
                  <td><?php echo $row['RATE']; ?></td>
                  <td><?php 
                  $total= ($row['QUANTITY'] * $row['RATE']);
                  echo number_format($total); ?></td>
                </tr>
                <?php
              }
            ?>
          </tbody>
          <tfoot class="font-weight-bold">
            <tr style="text-align: right; font-size: 18px;">
              <td colspan="5">Amount</td>
              <td><?php echo number_format($total_amount); ?></td>
            </tr>
          </tfoot>
        </table>
      </div>
      <div class="col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-12 mb-2" > <a style="margin-left:8.6%" class="btn btn-info " href="manage_purchase.php?menu=6">Back</a></div>
    </div>

    <?php
  }
?>
