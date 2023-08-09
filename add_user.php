<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Add New User</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script src="bootstrap/js/jquery.min.js"></script>
    <script src="/js/jquery3.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="font6/css/all.css">
    <link rel="shortcut icon" href="" type="image/x-icon">
    <link rel="stylesheet" href="font6/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/sidenav.css">
       <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/home.css">
    <script src="js/validateForm.js"></script>
    <script src="js/restrict.js"></script>
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
          createHeader('user-plus', 'Add  User', '<i class="fa fa-circle-plus" ></i>&nbsp;Add New User');
          // header section end
        ?>
        <div class="row" style="margin-top:45px">
          <div class="row col col-md-6">
            <div class="row" style="margin-left:4%">
  <form action="add_user.php?menu=0"  method="post">
<div class="input-group form-group">
              <div class="input-group-prepend">
              <span class="input-group-text "><i class="fas fa-user text-white"></i></span></span>
              </div>
    <input type="text" class="form-control" placeholder="First Name" name="fname" required >
</div>
<div class="input-group form-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user text-white"></i></span>
              </div>
    <input type="text" class="form-control" placeholder="last name" name="lname" required>
   
  </div>
  
<!-- supplier contact number control -->
<div class="row col col-md-12">
  <div class="input-group form-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-phone text-white"></i></span>
              </div>
    <input type="number" class="form-control" placeholder="Contact Number" name="contact_number" required>
    
  </div>
</div>
<!-- supplier email control -->
<div class="input-group form-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-envelope text-white"></i></span>
              </div>
    <input type="email" autocomplete="off" class="form-control" placeholder="Email" name="user_email" required>
</div>
<!-- supplier contact number control -->
   <div class="input-group form-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user-gear text-white"></i></span>
              </div>
    <select class="form-control" placeholder="user section" name="user_section"  required >
      <option value=""> Select Section</option>
      <option value="1">General</option>
      <option value="2">Private</option>
    </select>
    </div>
    <code class="text-danger small font-weight-bold float-right" name="section_error" style="display: none;"></code>
  

<!-- user roles control -->
<div class="input-group form-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user-gear text-white"></i></span>
              </div>
              <select class="form-control"  name="user_role" required>
      <option value=""> Select Role</option>
      <option value="1">Admin</option>
      <option value="2">Cashier</option>
          <option value="3">Pharmacisit</option>
    </select>
            </div> <!-- input-group class -->
           
            <!--end of user role-->



<div class="input-group form-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user text-white"></i></span>
              </div>
               <input type="text" class="form-control" aria-autocomplete="none" autocomplete="off" placeholder="username" name="username" required>
            </div> <!-- input-group class -->
           
<!-- supplier contact number control -->
<div class="input-group form-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-lock text-white"></i></span>
              </div>
              <input type="password" class="form-control" placeholder="password" name="user_password" required>
            </div> <!-- input-group class -->
            <code class="text-danger small font-weight-bold float-right" id="password_error" style="display: none;"></code>
<div class="input-group form-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-lock text-white"></i></span>
              </div>
              <input type="password" class="form-control" placeholder="Confirm" name="cpassword" required>
            </div> <!-- input-group class -->
            <code class="text-danger small font-weight-bold float-right" id="confirm_passwod_error" style="display: none;"></code>
<!-- supplier details content end -->

<div class="col col-md-12">
  <hr class="col-md-12 float-left" style="padding: 0px; width: 95%; border-top: 2px solid  #02b6ff;">
</div>

<!-- new user button -->
<div class="row col col-md-12">
  &emsp;
  <div class="form-group m-auto">
    <button name="addUser" class="btn btn-primary form-control set" > <i class="fa fa-circle-plus"></i>&nbsp;ADD</button>
  </div>
  </form>
  <!--
  &emsp;
  <div class="form-group">
    <button class="btn btn-success form-control">Save and Add Another</button>
  </div>
  -->
</div>
<!-- result message -->
<div id="msg" class="col-md-12 h5 text-success font-weight-bold text-center" style="font-family: sans-serif;"></div>
</div>
          </div>
        </div>
        
<?php
require_once("php/add_new_user.php");
?>
<hr style="border-top: 2px solid #ff5252;">
      </div>
    </div>
  </body>
</html>
