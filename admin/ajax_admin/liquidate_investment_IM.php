<?php
    require_once('../includes/instantiated_files.php');
    include('../../classes/algorithm_functions.php');
	$investment_id = $_POST['investment_id'];
	$days_so_far = $_POST['days_so_far'];
	$final_liquidation_amount = $_POST['final_liquidation_amount'];
	$user_id = $_POST['user_id'];
	$notification_type = 'alert';
	$notification_heading = 'Investment Liquidation';
	$notification = 'A request to liquidate your investment was sent by the Investment Manager';
	$send_liquidation_request = send_liquidation_request($investment_id,$user_id,$final_liquidation_amount,$days_so_far);
	$decode = json_decode($send_liquidation_request,true);
	echo $decode['msg'];
	if($decode['msg'] == "success"){
		$object->insert_into_notifications_tbl($notification_type, $user_id, $notification_heading, $notification);
		$object->insert_logs($_SESSION['adminid'], "Initiated Liquidation for a User's Investment");
	}
	


?>