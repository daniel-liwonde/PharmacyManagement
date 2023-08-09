<?php
  require "php/db_connection.php";

  if($con) {
    $query = "UPDATE admin_credentials SET IS_LOGGED_IN = 'false'";
	unset($_SESSION['USER_ID']);
    unset($_SESSION['FNAME']);
    unset($_SESSION['LNAME']);
    unset($_SESSION['ROLE']);
	session_destroy();
    $result = mysqli_query($con, $query);
    header("Location:../index.php");
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Logout</title>
    <script src="js/restrict.js"></script>
  </head>
  <body>

  </body>
</html>
