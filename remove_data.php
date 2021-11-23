<?php
session_start();
include 'autoloader.php';
$con = DB_OP::get_connection();
if(!empty($_GET)){
	$key_value = $_GET['id'];
	
	// $con->remove_data($table,$key,$key_value);
	$con->remove_data("user_details","user_id",$key_value);
}
header("location:Database_Details.php");

?>