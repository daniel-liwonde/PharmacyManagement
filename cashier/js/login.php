<?php
require "db_connection.php";
    if($con) {
        if(isset($_GET['uname']) && isset($_GET['pswd']))
        {
      $username = $_GET["uname"];
      $password = $_GET["pswd"];

      $query = "SELECT * FROM admin_credentials WHERE USERNAME = '$username' AND PASSWORD = '$password'";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_array($result);
      if($row)  {
        $role=$row['ROLE'];
        $query = "UPDATE admin_credentials SET IS_LOGGED_IN = '1' WHERE USERNAME='$username' AND PASSWORD='$password'";
        $result = mysqli_query($con, $query);
        session_start();
          $_SESSION['FNAME']=$row['FNAME'];
          $_SESSION['LNAME']=$row['LNAME'];
          $_SESSION['ROLE']=$row['ROLE'];
          session_write_close();
          if($role==1)
          header("location:home.php?menu=0");
          else if($role==2)
          header("location:cashier/home.php?menu=0");
          else
          header("location:phama/home.php?menu=0");
      }
      else
        $msg="Wrong login details, please retry";
    }
  }

?>