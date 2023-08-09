<?php
 require_once 'php/manage_invoice.php';
require "php/db_connection.php";
$invoice_number=$_GET['export'];
$query = "SELECT * FROM sales INNER JOIN customers ON sales.CUSTOMER_ID = customers.ID WHERE sales.INVOICE_NUMBER = '$invoice_number'";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_array($result);
      $customer_name = $row['NAME'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="C:\xampp\htdocs\cham\cashier\bootstrap\css\bootstrap.min.css">
		<script src="bootstrap/js/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
    <?php
    header("Content-Type:application/msexcel");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("content-disposition: attachment;filename={$customer_name}_Invoice.xlx");
    ?>
  </head>
  <body>
    <!-- including side navigations -->
    <?php 
    session_start();
    ?>
     <div class="container-fluid" style="width:82%; margin-left:18%">
    
       
                  <?php        
export($_GET['export']);
               ?>

    
        <!-- form content end -->
        <hr style="border-top: 2px solid #ff5252;">
    </div>
  </body>
</html>
<?php
exit; // end of word output
?>