<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Add New Supplier</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script src="js/jquery3.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="font6/css/all.css">
    <link rel="shortcut icon" href="" type="image/x-icon">
    <link rel="stylesheet" href="font6/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/sidenav.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/validateForm.js"></script>
    <script src="js/restrict.js"></script>
  </head>
  <body>
    <!-- including side navigations -->
    <?php include("sections/sidenav.php"); ?>

    <div class="container-fluid" style="width:82%; margin-left:18%">
      <div class="container">
        <!-- header section -->
        <?php
          require "php/header.php";
          createHeader('user-gear', 'Settings', '<i class="fa fa-gear"></i>Make system settings');
          // header section end
        ?>
        <div class="row" style="margin-top:45px">
          <div class="row col col-md-6">
           <!-- customer details content -->
<!-- customer name control -->
<div class="row col col-md-12">
    <div class="col-md-12">
  <fieldset>
    <legend> Add Payment methods</legend>
    <div class="row col col-md-12">
    
  <div class="col col-md-12 form-group">
    <div class="input-group form-group">
    
    <input type class="form-control" placeholder="enter payment method" id="paymethod" onblur="validateName(this.value, 'pmethod_error');" required> 
<div class="input-group-append">
                <span class="input-group-text set" id="addPay">Set</span>
              </div>
  </div>
    <code class="text-danger small font-weight-bold float-right" id="pmethod_error" style="display: none;"></code>
</div>
</div>
  </fieldset>
  
  </div>
  <div class="col-md-12">
  <fieldset>
    <legend> Add Product categories</legend>
    <div class="row col col-md-12">
       
  <div class="col col-md-12 form-group">
    <div class="input-group form-group">
    <input type class="form-control" placeholder="Enter product category one at a time" id="pcategory" onblur="validateName(this.value, 'pcategory_error');"> 
    <div class="input-group-append">
                <span class="input-group-text set" id="setCat">Set</span>
              </div>
    <code class="text-danger small font-weight-bold float-right" id="pcategory_error" style="display: none;"></code>
 
</div>

</div>
  </fieldset>
  
  </div>
</div>
<!-- result message -->
 <div id="msg" style="margin-left:10%"></div>

          </div>
        </div>
        <hr style="border-top: 2px solid #ff5252;">
      </div>
    </div>
    <script>
      $(document).ready(function () {
                                    $("#addPay").click(function () {
                                     
                                        $.ajax({
                                            url: 'php/new_settings.php',
                                            method: 'POST',
                                            data:{pmethod:$("#paymethod").val()
                                            },
                                            success: function (response) {
                                                $("#msg").html(response);
                                                

                                            },
                                            error: function (jqXHR, textStatus, errorThrown) {
                                                setTimeout(function () {
                                                    $("#msg").html("Request failed: " + textStatus + ", " + errorThrown);
                                                }, 13000
                                                )

                                            }
                                        });
                                    });
                                });
                                //set product category

                                $(document).ready(function () {
                                    $("#setCat").click(function () {
                                        $.ajax({
                                            url: 'php/new_settings.php',
                                            method: 'POST',
                                            data:{pCat:$("#pcategory").val()
                                            },
                                            success: function (response) {
                                                setTimeout(function(){
                                              $("#msg").html(response);
                                                },3000
                                                )
                                            },
                                            error: function (jqXHR, textStatus, errorThrown) {
                                                setTimeout(function () {
                                                    $("#msg").html("Request failed: " + textStatus + ", " + errorThrown);
                                                }, 13000
                                                )

                                            }
                                        });
                                    });
                                });
      </script>
  </body>
</html>
