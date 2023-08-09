<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Mulanje Mission  HMS - Login</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script src="bootstrap/js/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
   <link rel="stylesheet" href="font6/css/all.css">
    <link rel="shortcut icon" href="images/icon.svg" type="image/x-icon">
    <link rel="stylesheet" href="font6/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/index.css">
        <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <?php
    require_once('login_core.php');
    ?>
    <div class="container">
      <div class="card m-auto p-2">
        <div class="card-body">
          <form name="login-form" class="login-form" action=" " method="post">
            <div class="logo">
        			<img src="images/logo.png" class="profile" width="150" height="150"/>
              <h1 class="logo-caption"><span class="tweak">M</span>ulanje Mission HMS</h1>
        		
        		</div> <!-- logo class -->
            <div class="input-group form-group">
              <div class="input-group-prepend ">
                <span class="input-group-text"><i class="fas fa-user text-white"></i></span>
              </div>
              <input name="username" type="text" class="form-control" placeholder="username"  required>
            </div> <!--input-group class -->
            <div class="input-group form-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-key text-white"></i></span>
              </div>
              <input name="password" type="password" class="form-control" placeholder="password"  required>
            </div> <!-- input-group class -->
            <div class="form-group">
              <button class="btn btn-default btn-block btn-custom " style="background-color:#17A589; border:1px solid #17A589"><i class="fa fa-sign-in"></i>     Login</button>
            </div>
          </form><!-- form close -->
          <div class="m-6" > <p class="text-warning text-center"> <?php if(isset($msg)) echo $msg; $msg='';?></p></div>
        </div> <!-- cord-body class -->
        <div class="card-footer">
          <div class="text-center">
            <a class="text-light" href="#">Forgot password?</a>
          </div>
        </div> <!-- cord-footer class -->
      </div> <!-- card class -->
    </div> <!-- container class -->
  </body>
</html>
