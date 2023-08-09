<?php
require_once('functions.php');
if(isset($_GET['action']) && $_GET['action'] == "purchase")
  showPurchases($_GET['start_date'], $_GET['end_date']);
if(isset($_GET['action']) && $_GET['action'] == "sales")
  showSales($_GET['start_date'], $_GET['end_date']);
  if(isset($_GET['action']) && $_GET['action'] == "pSales")
  showProductSales($_GET['pName'],$_GET['pSection'],$_GET['start_date'], $_GET['end_date']);
  if(isset($_GET['action']) && $_GET['action'] == "Cashier")
  showCashierSalesDaily($_GET['start_date'], $_GET['end_date'], $_GET['cashier_id']);

function showPurchases($start_date, $end_date) {
  ?>
  <thead>
    <tr>
      <th>SL</th>
      <th>Purchase Date</th>
      <th>Invoice No</th>
      <th>Supplier Name</th>
      <th>Total Amount</th>
	  <th>Action</th>
    </tr>
  </thead>
  <tbody>
  <?php
  require "db_connection.php";
  if($con) {
    $seq_no = 0;
    $total = 0;
    if($start_date == "" || $end_date == "")
      $query = "SELECT * FROM purchases";
    else
      $query = "SELECT * FROM purchases WHERE PURCHASE_DATE BETWEEN '$start_date' AND '$end_date'";
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_array($result)) {
      $seq_no++;
      showPurchaseRow($seq_no, $row);
      $total = $total + $row['TOTAL_AMOUNT'];
    }
    ?>
    </tbody>
    <tfoot class="font-weight-bold">
      <tr style="text-align: right; font-size: 24px;">
        <td colspan="5" style="color: green;">&nbsp;Total Purchases =</td>
        <td style="color: red;"><?php echo number_format($total); ?></td>
      </tr>
    </tfoot>
    <?php
  }
}

function showPurchaseRow($seq_no, $row) {
  ?>
  <tr>
    <td><?php echo $seq_no; ?></td>
    <td><?php 
     $theDate=$row['PURCHASE_DATE'];
    formatDate($theDate);
   ?></td>
    <td><?php echo $row['INVOICE_NUMBER']; ?></td>
    <td><?php echo $row['SUPPLIER_NAME'] ?></td>
    <td><?php echo number_format($row['TOTAL_AMOUNT']); ?></td>
	 <td><a class="btn btn-success set" href="purchase_details.php?menu=6&invoice=<?php echo $row['INVOICE_NUMBER']; ?>"><i class="fa fa-list"></i>&nbsp;Details</a></td>
  </tr>
  <?php
}

function showSales($start_date, $end_date) {
  ?>
  <thead>
    <tr>
      <th>SL</th>
      <th>Sales Date</th>
      <th>Invoice Number</th>
      <th>Customer Name</th>
      <th>Total Amount(MK)</th>
      <th class="noprint">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php
  require "db_connection.php";
  if($con) {
    $seq_no = 0;
    $total = 0;
    if($start_date == "" || $end_date == "")
      $query = "SELECT * FROM invoices INNER JOIN customers ON invoices.CUSTOMER_ID = customers.ID";
    else
      $query = "SELECT * FROM invoices INNER JOIN customers ON invoices.CUSTOMER_ID = customers.ID WHERE INVOICE_DATE BETWEEN '$start_date' AND '$end_date'";
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_array($result)) {
      $seq_no++;
      //print_r($row);
      showSalesRow($seq_no, $row);
      $total = $total + $row['NET_TOTAL'];
    }
    ?>
    </tbody>
    <tfoot class="font-weight-bold">
      <tr style="text-align: right; font-size: 24px;">
        <td colspan="4" style="color: green;">&nbsp;Total Sales =</td>
        <td class="text-primary"><?php echo number_format($total); ?></td>
      </tr>
    </tfoot>
    <?php
  }
}

function showSalesRow($seq_no, $row) {
  ?>
  <tr>
    <td><?php echo $seq_no; ?></td>
    <td>
    <?php 
    $theDate=$row['INVOICE_DATE'];
    formatDate($theDate);?></td>
    <td><?php echo $row['INVOICE_ID']; ?></td>
    <td><?php echo $row['NAME']; ?></td>
    <td ><?php echo number_format($row['NET_TOTAL']) ?></td>
     <td>    <a title="view details" class="btn btn-danger btn-sm set" href="view_details.php?invoice=<?php echo $row['INVOICE_ID']; ?>&menu=1">
          <i class="fa fa-list"></i>
  </a></td>
  </tr>
  <?php
}
//chashier todays sales
function showCashierSalesRow($seq_no, $row) {
   require "db_connection.php";
  $cid= $row['CUSTOMER_ID'];
  $cus=mysqli_query($con,"SELECT * FROM  customers WHERE ID='$cid'") or die(mysqli_error($con));
  $crow=mysqli_fetch_array($cus);
$cname=$crow['NAME'];
  ?>
  <tr>
    <td><?php echo $seq_no; ?></td>
<td><?php formatDate($row['SALE_DATE']) ?></td>
	 <td><?php echo $row['INVOICE_NUMBER']; ?></td>
	 <td><?php echo $cname; ?></td>
	 <td><?php echo $row['MEDICINE_NAME']; ?></td>
	 <td><?php echo $row['QUANTITY']; ?></td>
	 <td><?php echo number_format($row['TOTAL']); ?></td>
  </tr>
  <?php
}

function showCashierSales($start_date, $end_date) {
  ?>
  <thead>
    <tr>
      <th>SL.</th>
	   <th>Sales Date</th>
      <th>Invoice Number</th>
	   <th>Customer Name</th>
	  <th>Sold Item</th>
	   <th>Quantity</th>
      <th>Total Amount(MK)</th>
    </tr>
  </thead>
  <tbody>
  <?php
  require "db_connection.php";
  if($con) {
    
    $seq_no = 0;
    $total = 0;
	$today=Date("Y-m-d");
	
	//$day=formatDate($today);
	//$by= "Sales Report today".$day."by".$_SESSION['LNAME'];
  session_start();
$cashier_id= $_SESSION['USER_ID'];
      $query = "SELECT cashier.*,custo.*,sold.* FROM admin_credentials AS cashier INNER JOIN 
  sales AS sold ON cashier.USER_ID = sold.CASHIER_ID	 
  INNER JOIN customers AS custo ON sold.CUSTOMER_ID=custo.ID
	 WHERE cashier.USER_ID='$cashier_id' AND sold.SALE_DATE BETWEEN '$start_date' AND '$end_date'";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
	if($result)
	{
    while($row = mysqli_fetch_array($result)) {
      $seq_no++;
      //print_r($row);
      showCashierSalesRow($seq_no, $row);
      $total = $total + $row['TOTAL'];
    }
    ?>
    </tbody>
    <tfoot class="font-weight-bold">
      <tr style="text-align: right; font-size: 24px;">
        <td colspan="6" style="color: green;">&nbsp;Total Sales=</td>
        <td class="text-primary"><?php echo number_format($total); ?></td>
      </tr>
    </tfoot>
    <?php
	}
	else
	{
		echo"<font color='red'>No Report was found </font>";
	}
  }
}

function showCashierSalesDaily($start_date, $end_date, $cashier_id) {
  ?>
  <thead>
    <tr>
      <th>SL.</th>
	   <th>Sales Date</th>
      <th>Invoice Number</th>
	   <th>Customer Name</th>
	  <th>Sold Item</th>
	   <th>Quantity</th>
      <th>Total(MK)</th>
    </tr>
  </thead>
  <tbody>
  <?php
  require "db_connection.php";
  if($con) {
    
    $seq_no = 0;
    $total = 0;
	$query = ($start_date == "" || $end_date == "") ? "SELECT  * FROM  sales WHERE CASHIER_ID='$cashier_id'" : "SELECT * FROM sales
	 WHERE CASHIER_ID='$cashier_id' AND SALE_DATE BETWEEN '$start_date' AND '$end_date'";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    
    while($row = mysqli_fetch_array($result)) {
      $seq_no++;
      //print_r($row);
      showCashierSalesRow($seq_no, $row);
      $total = $total + $row['TOTAL'];
    }
    ?>
    </tbody>
    <tfoot class="font-weight-bold">
      <tr style="text-align: right; font-size: 24px;">
        <td colspan="6" style="color: green;">&nbsp;Total Sales=</td>
        <td class="text-primary"><?php echo number_format($total); ?></td>
        
      </tr>
    </tfoot>
    <?php
  }
}
//end cashier 
//start product sale row
function showProductSalesRow($seq_no, $row,$cName,$pSection,$cashierName) {
  ?>
  <tr>
    <td><?php echo $seq_no; ?></td>
<td><?php formatDate($row['SALE_DATE']) ?></td>
	 <td><?php echo $row['INVOICE_NUMBER']; ?></td>
	 <td><?php echo $cName; ?></td>
   <td><?php echo $cashierName ?></td>
	 <td><?php echo $row['MEDICINE_NAME']; ?></td>
   <td><?php echo($pSection==3)? "ALL" : (($row['SECTION']==1)?"General":"Private"); ?></td>
	 <td><?php echo $row['QUANTITY']; ?></td>
	 <td><?php echo number_format($row['TOTAL']); ?></td>
  </tr>
  <?php
}
//end product sale row
//start show product sales
function showProductSales($pName,$pSection,$start_date, $end_date) {
  ?>
  <thead>
    <tr>
      <th>SL.</th>
	   <th>Sales Date</th>
      <th>Inv.No.</th>
	   <th>Customer</th>
      <th>Cashier</th>
	  <th>Sold Item</th>
    <th>Section</th>
	   <th style="width:4%">Qty</th>
      <th>Total(MK)</th>
    </tr>
  </thead>
  <tbody>
  <?php
  require "db_connection.php";
  if($con) {
    
    $seq_no = 0;
    $total = 0;
  if ($pName == "ALL") {//all products
    if ($pSection == 3) { // both sections
        $query = "SELECT * FROM sales WHERE SALE_DATE BETWEEN '$start_date' AND '$end_date'";
    } else {// if specific section
        $query = "SELECT * FROM sales WHERE SECTION = '$pSection' AND SALE_DATE BETWEEN '$start_date' AND '$end_date'";
    }//end specific section
} //end all products
else { //specific product
    if ($pSection == 3) {//if we want a specific product sold in both private and general
        $query = "SELECT * FROM sales  WHERE MEDICINE_NAME = '$pName' AND SALE_DATE BETWEEN '$start_date' AND '$end_date'";
    }//end both sections
     else {//specific product speccific section
        $query = "SELECT * FROM sales WHERE SECTION = $pSection AND MEDICINE_NAME = '$pName' AND SALE_DATE BETWEEN '$start_date' AND '$end_date'";
    }//end specific section
}//end specific product

$result = mysqli_query($con, $query) or die(mysqli_error($con));

	if($result)
	{
    while($row = mysqli_fetch_array($result)) {
      $seq_no++;
      //print_r($row);
      $customer=$row['CUSTOMER_ID'];
      $cust=mysqli_query($con,"SELECT * FROM customers WHERE ID='$customer'");
      $getCustomer=mysqli_fetch_assoc($cust);
      $cName= $getCustomer['NAME'];
      $cashierID=$row['CASHIER_ID'];
      $cash=mysqli_query($con,"SELECT * FROM admin_credentials WHERE USER_ID='$cashierID'");
      $getCashier=mysqli_fetch_assoc($cash);
      $cashierName= $getCashier['LNAME']." ".$getCashier['FNAME'];
      showProductSalesRow($seq_no, $row,$cName,$pSection,$cashierName);
      $total = $total + $row['TOTAL'];
    }
    ?>
    </tbody>
    <tfoot class="font-weight-bold">
      <tr style="text-align: right; font-size: 24px;">
        <td colspan="8" style="color: green;">&nbsp;Total Sales=</td>
        <td class="text-primary"><?php echo number_format($total); ?></td>
      </tr>
    </tfoot>
    <?php
	}
	else
	{
		echo"<font color='red'>No Report was found </font>";
	}
  }
}
//end show product sales
function displayProductSales()
{
  showProductSales($_GET['pName'],$_GET['pSection'],$_GET['start_date'], $_GET['end_date']);
}
?>
