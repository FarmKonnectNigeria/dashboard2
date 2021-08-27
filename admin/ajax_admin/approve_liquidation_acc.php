<?php
   include('../includes/instantiated_files.php');
   require_once('../../classes/algorithm_functions.php');
    $investment_id = $_POST['investment_id'];
    $amount_to_be_liquidated = $_POST['amount_to_be_liquidated'];
     $user_id = $_POST['user_id'];
     $notification_type = 'alert';
    $notification_heading = 'Liquidation Request';
    $notification = 'Hello, your liquidation request has been approved and your wallet has been credited with '.$amount_to_be_liquidated;
    $approve_liquidation_request = confirm_liquidated_investment($amount_to_be_liquidated, $investment_id, $user_id);
    $approve_liquidation_request_decode = json_decode($approve_liquidation_request, true);
    if($approve_liquidation_request_decode['status'] == 0){
    	echo "error";
    }else{
    	echo "success";
        $object->insert_logs($_SESSION['adminid'], 'Approved Liquidation request');
        $object->insert_into_notifications_tbl($notification_type, $user_id, $notification_heading, $notification);
    }
?>