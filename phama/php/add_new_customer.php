<?php
  require "db_connection.php";
  if($con) {
    $name = ucwords($_GET["name"]);
    $contact_number = $_GET["contact_number"];
    $village = ucwords($_GET["village"]);
     $dbirth = ucwords($_GET["dbirth"]);
    $TA = ucwords($_GET["TA"]);
    $district = ucwords($_GET["district"]);
     $gender = ucwords($_GET["gender"]);

    $query = "SELECT * FROM customers WHERE CONTACT_NUMBER = '$contact_number'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    if($row)
      echo "<font color='red'>Customer ".$row['NAME']." with contact number $contact_number already exists!</font>";
    else {
      $query = "INSERT INTO customers (NAME, CONTACT_NUMBER, VILLAGE, D_BIRTH, GENDER,DISTRICT, TA)
       VALUES('$name', '$contact_number', '$village', '$dbirth', '$gender','$district','$TA')";
      $result = mysqli_query($con, $query);
      if(!empty($result))
  			echo "$name added...";
  		else
  			echo "<font color='red'>Failed to add $name!</font>".mysqli_error($con);
    }
  }
?>
