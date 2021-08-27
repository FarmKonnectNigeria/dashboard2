<?php
session_start();
require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    require_once('../../classes/algorithm_functions.php');
    $status = $_POST['status'];
    $request_id = $_POST['request_id'];
    $assigned_by = $_SESSION['adminid'];
    if($status == 1){
        $new_stat = "escalated";
    }else if($status == 2){
        $new_stat="resolved";
    }
    //print_r($_POST);
    $object = new DbQueries();
    $notification_type = 'alert';
    $notification_heading = 'Inter-wallet Transfer';
    $notification = 'Your request to transfer funds has been '.$new_stat;
    $update_processing_status = $object->update_with_one_param('transfer_log', 'unique_id',$request_id,'processing_status',$status);
    $update_processing_status_decode = json_decode($update_processing_status, true);
    if($update_processing_status_decode['status'] == 0){
    echo 500;
    }else{
    	echo 200;
    	$description = "Updated Pending Trasfer Status ";
		$object->insert_logs($assigned_by, $description);
        $get_user_id = $object->get_one_row_from_one_table('transfer_log', 'unique_id', $request_id);
        $object->insert_into_notifications_tbl($notification_type, $get_user_id['sender_id'], $notification_heading, $notification);
    }
 ?>