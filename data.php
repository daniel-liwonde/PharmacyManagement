<?php
 if(isset($_GET['cashier_id']))
 {
    $id=$_GET['cashier_id'];
    $start= $_GET['start_date'];
    $end=$_GET['end_date'];
    echo  $end;
$dataPoints = array( 
	array("y" => 3373.64, "label" => $start ),
	array("y" => 2435.94, "label" => $end),
	array("y" => 1842.55, "label" => "China" ),
	array("y" => 1828.55, "label" => "Russia" ),
	array("y" => 1039.99, "label" => "Switzerland" ),
	array("y" => 765.215, "label" => "Japan" ),
	array("y" => 612.453, "label" => "Netherlands" )
);
 }
 
?>