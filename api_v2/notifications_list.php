<?php
include("../includes/session.php");
require_once("../classes/db_class.php");
require_once('db_connect.php');
include("../includes/config.php");
include("api_auth.php");
header('Content-Type: application/json');
$object = new DbQueries;
if(!isset($_GET['uid']) || !isset($_GET['category'])){
	echo json_encode(["status"=>"0", "msg"=>"empty_fields"]);
}else{

	$uid = $_GET['uid'];
	$category = $_GET['category'];
	$get_all_notifications = $object->get_rows_from_one_table_by_id('notifications_tbl', 'user_id', $uid);
	$get_alerts = $object->get_rows_from_one_table_by_two_params('notifications_tbl','user_id', $uid, 'notification_type', 'alert');
	$get_updates = $object->get_rows_from_one_table_by_two_params('notifications_tbl','user_id', $uid, 'notification_type', 'update');
	$get_blog = $object->get_rows_from_one_table_by_two_params('notifications_tbl','user_id', $uid, 'notification_type', 'blog');
	if($category == 'all'){
		if($get_all_notifications == null){
	   		echo json_encode(["status"=>"0", "msg"=>"no_available_notifications"]); 
		}else{
			echo json_encode(["status"=>"1", "msg"=>$get_all_notifications]);
		}
	}
	else if($category == 'alert'){
		if($get_alerts == null){
	   		echo json_encode(["status"=>"0", "msg"=>"no_available_alert"]); 
		}else{
			echo json_encode(["status"=>"1", "msg"=>$get_alerts]);
		}
	}
	else if($category == 'update'){
		if($get_updates == null){
	   		echo json_encode(["status"=>"0", "msg"=>"no_available_update"]); 
		}else{
			echo json_encode(["status"=>"1", "msg"=>$get_updates]);
		}
	}
	else if($category == 'blog'){
		if($get_blog == null){
	   		echo json_encode(["status"=>"0", "msg"=>"no_available_blog"]); 
		}else{
			echo json_encode(["status"=>"1", "msg"=>$get_blog]);
		}
	}
}
?>