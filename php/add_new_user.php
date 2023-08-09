<?php
  require "db_connection.php";
  if(isset($_POST['addUser']))
  {
  if($con) {
    $fname = ucwords($_POST["fname"]);
	 $lname = ucwords($_POST["lname"]);
	 $user_role = $_POST["user_role"];
	 $user_email = $_POST["user_email"];
    $contact_number = $_POST["contact_number"];
    $user_password = $_POST["user_password"];
	$username = $_POST["username"];
	$section = $_POST["user_section"];
  $cpassword=$_POST["cpassword"];
     if($user_password !=$cpassword)
     echo "<font color='red'>passwords{$user_password} and confirmed{$cpassword} password doesnt match";
else{
  if(strlen($user_password)<7)
  {
    echo "<font color='red'>passwords should not be less than 7 characters"; 
  }
  else
  {
    $query = "SELECT * FROM admin_credentials WHERE  USERNAME='$username' OR EMAIL='$user_email' OR CONTACT_NUMBER=' $contact_number'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    if($row)
      echo "<font color='red'>username already in use!</font>";
    else {
      $query = "INSERT INTO admin_credentials (FNAME,LNAME, CONTACT_NUMBER, EMAIL,SECTION,USERNAME,PASSWORD,ROLE)
       VALUES('$fname','$lname','$contact_number', '$user_email', '$section', '$username','$user_password','$user_role')";
      $result = mysqli_query($con, $query) or die(mysqli_error($con));
      if(!empty($result))
  			echo "<font color='green'>$fname added...</font>";
  		else
  			echo "<font color='red'>Failed to add $fname!</font>".mysqli_error($con);
    }
    }
  }
}
  }
?>
