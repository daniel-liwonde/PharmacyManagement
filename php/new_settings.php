<?php
require "db_connection.php";
if(isset($_POST['pmethod'])){
$method =$_POST['pmethod'];
if($method=="")
echo "<font color='red'>Payment method can not be blank</font>";
else
{
$data=mysqli_query($con,"SELECT * FROM payment_methods WHERE payment_name='$method'") or die(mysqli_error($con));
if(mysqli_num_rows($data)==0){
$insert=mysqli_query($con,"INSERT INTO payment_methods (payment_name) VALUES('$method')") or die(mysqli_error($con));
echo $insert? " <p class='setc'>Payment method set</font>": "<font color='red'>Error! Could not set payment method</font>s";
}
else
echo "<font color='red'>Method already set</font>";

}
}
//setting product category
if(isset($_POST['pCat'])){
$prodCat =$_POST['pCat'];
if($prodCat=="")
echo "<font color='red'>Product category can not be blank</font>";
else
{
$data=mysqli_query($con,"SELECT * FROM product_categories WHERE category='$prodCat'") or die(mysqli_error($con));
if(mysqli_num_rows($data)==0){
$insert=mysqli_query($con,"INSERT INTO product_categories (category) VALUES('$prodCat')") or die(mysqli_error($con));
echo $insert? "<p class='setc'>Product category{$prodCat} is set": "<font color='red'>Error! Could not set product category</font>";
}
else
echo "<font color='red'>product category already set</font>";
}
}
?>