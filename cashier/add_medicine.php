<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Add New Medicine</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script src="bootstrap/js/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
   <link rel="stylesheet" href="font6/css/all.css">
    <link rel="shortcut icon" href="images/icon.svg" type="image/x-icon">
    <link rel="stylesheet" href="font6/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/sidenav.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/suggestions.js"></script>
     <script src="js/addMedicine.js"></script>
     <script src="js/addProduct.js"></script>
    <script src="js/validateForm.js"></script>
    <script src="js/restrict.js"></script>
  </head>
  <body>
    <div id="add_new_supplier_model">
      <div class="modal-dialog">
      	<div class="modal-content">
      		<div class="modal-header" style="background-color: #ff5252; color: white">
            <div class="font-weight-bold">Add New Supplier</div>
      			<button class="close" style="outline: none;" onclick="document.getElementById('add_new_supplier_model').style.display = 'none';"><i class="fa fa-close"></i></button>
      		</div>
      		<div class="modal-body">
            <?php
            session_start();
              include('sections/add_new_supplier.html');
              function findProduct()
              {
                require "php/db_connection.php";
              $data=mysqli_query($con,"SELECT * FROM product_categories") or die(mysqli_error($con));
              while($row=mysqli_fetch_assoc($data))
              {
              echo"<option> {$row['category']}</option>";
              }
              }
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
          createHeader('shopping-bag', 'Products', '<i class="fa fa-circle-plus"></i>&nbsp;Add New Product');
        ?>
        <!-- header section end -->
            
        <!-- form content -->
        <div class="row" style="margin-top:45px">
          <div class="row col col-md-6">
            <div class="row col col-md-12">
  <div class="col col-md-8 form-group">
    <label class="font-weight-bold" for="item_name">Item Name :</label>
    <input type="text" class="form-control" id="item_name" placeholder="item name" onblur="notNull(this.value, 'item_name_error');">
    <code class="text-danger small font-weight-bold float-right" id="item_name_error" style="display: none;"></code>
  </div>
  <div class="col col-md-4 form-group">
   
    <label class="font-weight-bold" for="item_expires"> Expires?:</label>
     <input type="checkbox" style="position:absolute; margin-top:24%" id="item_expires">
  </div>
</div>
<!--   -->
<!--   -->
<div class="row col col-md-12">
  <div class="col col-md-8 form-group">
    <label class="font-weight-bold" for="item_cat">Item Category </label>
    <select id="item_cat"  class="form-control"  onblur="notNull(this.value, 'item_cat_error');" >
      <option>Select category</option>
       <?php findProduct() ?>
          </select>
    <code class="text-danger small font-weight-bold float-right" id="item_cat_error" style="display: none;"></code>
  </div>
  <div class="col col-md-4">
     <label class="font-weight-bold" for="item_cat">Reducible?</label>
     <input type="checkbox" style="position:absolute; margin-top:24%" id="item_service">
            </div>
</div>
<div class="row col col-md-12">
  <div class="col col-md-12 form-group">
    <label class="font-weight-bold" for="item_price">Item Price :</label>
    <input id="item_price" type="number" class="form-control"  placeholder="Selling price" onblur="notNull(this.value, 'item_price_error');">
    <code class="text-danger small font-weight-bold float-right" id="item_price_error" style="display: none;"></code>
  </div>
</div>
<!--
<div class="row col col-md-12">
  <div class="col col-md-5 font-weight-bold" style="color: green;cursor:pointer" onclick="document.getElementById('add_new_supplier_model').style.display = 'block';">
    <i class="fa fa-plus"></i>Add New Supplier
  </div>
</div>
!-->
<hr>

<div class="col col-md-12">
  <hr class="col-md-12 float-left" style="padding: 0px; width: 95%; border-top: 2px solid  #02b6ff;">
</div>

<!-- new user button -->
<div class="row col col-md-12">
  &emsp;
  <div class="form-group m-auto">
    <button class="btn btn-primary form-control set" onclick="addProduct();"><i class="fa fa-circle-plus"></i>&nbsp;ADD</button>
  </div>
  <!--
  &emsp;
  <div class="form-group">
    <button class="btn btn-success form-control">Save and Add Another</button>
  </div>
-->
</div>
<!-- customer details content end -->
<!-- result message -->
<div id="medicine_acknowledgement" class="col-md-12 h5 text-success font-weight-bold text-center" style="font-family: sans-serif;"></div>
          </div>
        </div>

        <hr style="border-top: 2px solid #ff5252;">
        <!-- form content end -->
      </div>
    </div>
  </body>
</html>
