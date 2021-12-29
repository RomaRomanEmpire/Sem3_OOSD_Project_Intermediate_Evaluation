<?php
session_start();
include 'autoloader.php';
$conn = DB_OP::get_connection();
$db_manager = unserialize($conn->get_column_value("user_details","user_id","=",$_SESSION['user_id'],"u_object",""));
$db_manager->set($conn);
$db_manager->set_row_id($_SESSION['user_id']);
if(!empty($_GET)){
	$key_value = $_GET['id'];
	
	// $con->remove_data($table,$key,$key_value);
	// $con->remove_data("user_details","user_id",$key_value);
	$db_manager->remove_L_P_User($key_value);
}
header("location:user_Details.php");

?>