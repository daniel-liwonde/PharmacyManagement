<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Dashboard - Home</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script src="bootstrap/js/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="font6/css/all.css">
    
    <link rel="stylesheet" href="font6/css/font-awesome.min.css">
    <link rel="shortcut icon" href="images/icon.svg" type="image/x-icon">
    <link rel="stylesheet" href="css/sidenav.css">
    <link rel="stylesheet" href="css/home.css">
    <script src="js/restrict.js"></script>
     <script src="js/check_orders.js"></script>
  </head>
  <body>
    <?php 
    session_start();
    include "sections/sidenav.php"; ?>
    <div class="container-fluid" style="width:82%; margin-left:18%">
      <div class="container">
        <!-- header section -->
        <?php
          require "php/header.php";
          createHeader('dashboard', 'Dashboard', '<i class="fa fa-home"></i>&nbsp;Home');
        ?>
        <!-- form content -->
        <div class="row" syle="margin-top:45px" id="display_orders">
          <!-- badges here         -->
         

          <!--  budges edges here --->

        </div>

        <hr style="border-top: 2px solid #ff5252;">

        <div class="row">


          <!--  reports here      -->

<div class="row col col-xs-8 col-sm-8 col-md-8 col-lg-8">

            <?php
              function createSection1($location, $title, $table) {
                require 'php/db_connection.php';

                $query = "SELECT * FROM $table";
                if($title == "Out of Stock")
                  $query = "SELECT * FROM $table WHERE QUANTITY = 0 AND REDUCIBLE=1";

                $result = mysqli_query($con, $query) or die(mysqli_error($con));
                $count = mysqli_num_rows($result);


                if($title == "Expired") {
                  $exp = "SELECT * FROM medicines INNER JOIN medicines_stock ON medicines.NAME = medicines_stock.NAME INNER JOIN 
      purchases ON medicines_stock.INVOICE_NUMBER=purchases.INVOICE_NUMBER
      WHERE medicines.EXPIRES=1";
                  
                   $res = mysqli_query($con, $exp) or die(mysqli_error($con));
                  $count = 0;
                  while($row = mysqli_fetch_array($res)) {
                    $expiry_date = $row['EXPIRY_DATE'];
                    if(!empty($expiry_date)){
                    if(substr($expiry_date, 3) < date('y'))
                      $count++;
                    else if(substr($expiry_date, 3) == date('y')) {
                      if(substr($expiry_date, 0, 2) < date('m'))
                        $count++;
                    }
                  }
                  }
                }
                echo '
                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4" style="padding: 10px">
                    <div class="dashboard-stats" onclick="location.href=\''.$location.'\'">
                      <a class="text-dark text-decoration-none" href="'.$location.'">
                        <span class="h4">'.$count.'</span>
                        <span class="h6"><i class="fa fa-play fa-rotate-270 text-warning"></i></span>
                        <div class="small font-weight-bold">'.$title.'</div>
                      </a>
                    </div>
                  </div>
                ';
              }
              createSection1('manage_customer.php?menu=6', 'Total Customers', 'customers');
              createSection1('manage_supplier.php?menu=6', 'Total Supplier', 'suppliers');
              createSection1('manage_medicine.php?menu=6', 'Total Products', 'medicines');
              createSection1('manage_medicine_stock.php?out_of_stock&menu=6', 'Out of Stock', 'medicines_stock');
              createSection1('manage_medicine_stock.php?expired&menu=6', 'Expired', 'medicines_stock');
              createSection1('manage_invoice.php?menu=6', 'Total Invoice', 'invoices');
            ?>

          </div>

          <div class="col col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding: 7px 0; margin-left: 15px;">
            <div class="todays-report">
              <div class="h5">Todays Report</div>
              <table class="table table-bordered table-striped table-hover">
                <tbody>
                  <?php
                    require 'php/db_connection.php';
                    if($con) {
                      $date = date('Y-m-d');
                  ?>
                  <tr>
                    <?php
                      $total = 0;
                      $query = "SELECT NET_TOTAL FROM invoices WHERE INVOICE_DATE = '$date'";
                      $result = mysqli_query($con, $query);

                      while($row = mysqli_fetch_array($result))
                        $total = $total + $row['NET_TOTAL'];
                    ?>
                    <th>Total Sales</th>
                    <th class="text-success">K. <?php echo $total; ?></th>
                  </tr>
                  <tr>
                    <?php
                      //echo $date;
                      $total = 0;
                      $query = "SELECT TOTAL_AMOUNT FROM purchases WHERE PURCHASE_DATE = '$date'";
                      $result = mysqli_query($con, $query);
                      while($row = mysqli_fetch_array($result))
                        $total = $total + $row['TOTAL_AMOUNT'];
                    }
                    ?>
                    <th>Total Purchase</th>
                    <th class="text-danger">K. <?php echo $total; ?></th>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <!-- reports ends here -->

        </div>
        <!-- form content end -->

        <hr style="border-top: 2px solid #ff5252;">

      </div>
    </div>
    <script>
        setInterval(function() {
            <?php echo"printValues()"; ?>
        }, 3000); // 3 minutes in milliseconds
    </script>
  </body>
</html>
