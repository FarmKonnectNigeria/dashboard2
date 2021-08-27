<?php
    require_once('../includes/instantiated_files.php');
    include('../../classes/algorithm_functions.php');
	$investment_id = $_POST['invst_id'];
	$owner_id = $_POST['owner_id'];
	$receiver_id = $_POST['receiver_id'];
	$added_by = $_SESSION['adminid'];
	$notification_type = 'update';
	$notification_heading = 'Transfer of Investment Ownership';
	$notification = 'A transfer of investment ownership request has been sent on your behalf. You will be notified when the request is approved';
	$send_transfer_of_ownership_request = send_transfer_of_ownership_request($owner_id, $receiver_id, $investment_id, $added_by);
	$decode = json_decode($send_transfer_of_ownership_request,true);
	echo $decode['msg'];
	if($decode['msg'] == "success"){
		$object->insert_into_notifications_tbl($notification_type, $owner_id, $notification_heading, $notification);
		$object->insert_logs($_SESSION['adminid'], 'Sent Transfer of Ownership Request');
	}
	


?>