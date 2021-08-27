<?php
session_start();
require_once("../classes/db_class.php");
require_once('db_connect.php');
include("../includes/config.php");
include("api_auth.php");
header('Content-Type: application/json');
$object = new DbQueries;
$uid = $_GET['uid'];
$get_notifications_number = $object->get_number_of_rows_two_params('notifications_tbl','user_id',$uid,'status', 0);
if($get_notifications_number !== null){
	echo json_encode(["status"=>"1", "msg"=>$get_notifications_number]); 
}else{
	echo json_encode(["status"=>"0", "msg"=>"error"]); 
}
?>