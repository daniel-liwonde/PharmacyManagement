<?php
  require "db_connection.php";
  if($con) {
    $name = ucwords($_GET["name"]);
    $price = $_GET["price"];
    $category=ucwords($_GET["category"]);
      $expires=$_GET["expires"];
      $reducible=$_GET["reduce"];
    //$generic_name = ucwords($_GET["generic_name"]);
    //$suppliers_name = $_GET["suppliers_name"];
    if($reducible==0){
    $query = "SELECT * FROM medicines WHERE UPPER(NAME) = '".strtoupper($name)."' AND  CATEGORY='$category'";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    $row = mysqli_fetch_array($result);
    if($row)
      echo "<font color='red'>Item $name of category $category already exists !</font>";
    else {
      $query = "INSERT INTO medicines (NAME, CATEGORY, EXPIRES,SELL_PRICE) VALUES('$name', '$category', '$expires','$price'
      )";
      $result = mysqli_query($con, $query) or die(mysqli_error($con));
      
      if(!empty($result))
  			echo "$name added...";
  		else
  			echo "Failed to add $name!";
    }
  }
  else
      {
        $frow=mysqli_query($con,"SELECT * FROM medicines_stock WHERE NAME='$name'")or die(mysqli_error($con));
        if(mysqli_num_rows($frow)==0){
       mysqli_query($con,"INSERT INTO medicines_stock(NAME, MRP, REDUCIBLE,QUANTITY) VALUES('$name', '$price', 0,1)") or die(mysqli_error($con));
       echo "Non reducible item added";
      }
        else
        {
          echo "<font color='red'>Non reucible Item already added</font>";
        } 
      }
  }
?>
