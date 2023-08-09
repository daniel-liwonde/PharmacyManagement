 <?php
       require_once("db_connection.php");
            function createSection2($icon, $location, $title) {
              echo '
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3" style="padding: 10px;">
              		<div class="dashboard-stats" style="padding: 30px 15px;" onclick="location.href=\''.$location.'\'">
              			<div class="text-center">
                      <span class="h1" ><i style="color:#17A589" class="fa fa-'.$icon.' p-2"></i></span>
              				<div class="h5">'.$title.'</div>
              			</div>
              		</div>
                </div>
              ';
            }
            $sql="SELECT DISTINCT sales.INVOICE_NUMBER,customers.ID ,customers.NAME FROM sales INNER JOIN customers ON customers.ID=sales.CUSTOMER_ID WHERE sales.TAKEN=0";
            $customer=mysqli_query($con,$sql) or die(mysqli_error($on));
            while($row=mysqli_fetch_assoc($customer))
            {
              $name=$row['NAME'];
              $invoice= $row['INVOICE_NUMBER'];
            createSection2('address-card', 'view_details.php?menu=0&invoice='.$invoice, $name);
            }
            //createSection2('hand-holding-medical', 'add_customer.php?menu=2', 'Add New Customer ');
           // createSection2('shopping-bag', 'add_medicine.php?menu=3', 'Add New Medicine');
            //createSection2('user-plus', 'add_user.php?menu=0', 'Add New User');
            //createSection2('bar-chart', 'add_purchase.php?menu=5', 'Add New Purchase');
            //createSection2('book', 'sales_report.php?menu=6', 'Sales Report');
           // createSection2('book', 'purchase_report.php?menu=6', 'Purchase Report');
          ?>