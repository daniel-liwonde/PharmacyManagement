<?php
require "php/db_connection.php";
    if($con) {
        if(isset($_POST['username']) && isset($_POST['password']))
        {
      $username = $_POST["username"];
      $password = $_POST["password"];

      $query = "SELECT * FROM admin_credentials WHERE USERNAME = '$username' AND PASSWORD = '$password'";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_array($result);
      if($row)  {
        $role=$row['ROLE'];
        $query = "UPDATE admin_credentials SET IS_LOGGED_IN = '1' WHERE USERNAME='$username' AND PASSWORD='$password'";
        $result = mysqli_query($con, $query);

session_id('admin'); // Set a unique session identifier for admin
session_start();
$_SESSION['FNAME'] = $row['FNAME'];
$_SESSION['LNAME'] = $row['LNAME'];
$_SESSION['ROLE'] = $row['ROLE'];
$_SESSION['SECTION'] = $row['SECTION'];
$_SESSION['USER_ID'] = $row['USER_ID'];
session_write_close();

if ($role == 1) {
    header("location:home.php?menu=0");
} elseif ($role == 2) {
    session_id('cashier'); // Set a unique session identifier for cashier
    session_start();
    $_SESSION['FNAME'] = $row['FNAME'];
    $_SESSION['LNAME'] = $row['LNAME'];
    $_SESSION['ROLE'] = $row['ROLE'];
    $_SESSION['SECTION'] = $row['SECTION'];
    $_SESSION['USER_ID'] = $row['USER_ID'];
    session_write_close();
    header("location:cashier/home.php?menu=0");
} else {
    session_id('phama'); // Set a unique session identifier for phama
    session_start();
    $_SESSION['FNAME'] = $row['FNAME'];
    $_SESSION['LNAME'] = $row['LNAME'];
    $_SESSION['ROLE'] = $row['ROLE'];
    $_SESSION['SECTION'] = $row['SECTION'];
    $_SESSION['USER_ID'] = $row['USER_ID'];
    session_write_close();
    header("location:phama/home.php?menu=0");
}
      }
      else
      {
        $msg="Wrong login details, please retry";
      }
    }

  }
  

?>