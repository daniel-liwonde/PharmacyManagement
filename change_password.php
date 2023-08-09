<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Add New Customer</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script src="bootstrap/js/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="font6/css/all.css">
    <link rel="shortcut icon" href="" type="image/x-icon">
    <link rel="stylesheet" href="font6/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/sidenav.css">
    <link rel="stylesheet" href="css/home.css">
    <script src="js/validateForm.js"></script>
    <script src="js/my_profile.js"></script>
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
          createHeader('key', 'Change Passowrd', 'Set New Password');
          // header section end
        ?>
        <div class="row" style="margin-top:45px">
          <div class="row col col-md-6">

            <div class="row col col-md-12">
              <div class="col col-md-12 form-group">
                <label class="font-weight-bold" for="old_password">Old Password :</label>
                <input id="old_password" type="text" class="form-control" placeholder="old password" onblur="checkAdminPassword(this.value, 'old_password_error');">
                <code class="text-danger small font-weight-bold float-right mb-2" id="old_password_error" style="display: none;"></code>
              </div>
            </div>

            <div class="row col col-md-12">
              <div class="col col-md-12 form-group">
                <label class="font-weight-bold" for="password">New Password :</label>
                <input id="password" type="text" class="form-control" placeholder="password" style="max-height: 100px;">
                <code class="text-danger small font-weight-bold float-right mb-2" id="password_error" style="display: none;"></code>
              </div>
            </div>

            <div class="row col col-md-12">
              <div class="col col-md-12 form-group">
                <label class="font-weight-bold" for="confirm_password">Confirm New Password :</label>
                <input id="confirm_password" type="password" class="form-control" placeholder="confirm password">
                <code class="text-danger small font-weight-bold float-right mb-2" id="confirm_password_error" style="display: none;"></code>
              </div>
            </div>

            <div class="row col col-md-12 m-auto" id="change">
              <div class="col col-md-4 form-group float-right"></div>
              <div id="change_button" class="col col-md-4 form-group float-right">
                <button class="btn btn-warning form-control font-weight-bold" onclick="changePassword();">Reset Password</button>
              </div>
              <div id="password_button" class="col col-md-4 form-group float-right">
                <a href="my_profile.php?menu=0" class="btn btn-primary form-control font-weight-bold">Profile</a>
              </div>
            </div>

          </div>
        </div>
        <hr style="border-top: 2px solid #ff5252;">
      </div>
    </div>
  </body>
</html>
