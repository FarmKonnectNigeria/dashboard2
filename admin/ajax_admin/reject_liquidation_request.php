<?php
   include('../includes/instantiated_files.php');
   require_once('../../classes/algorithm_functions.php');
    $investment_id = $_POST['investment_id'];
     $notification_type = 'alert';
    $notification_heading = 'Liquidation Request';
    $notification = 'Hello, your liquidation request has been rejected';
    $get_user_id = $object->get_one_row_from_one_table('liquidated_investments_tbl', 'investment_id',$investment_id);
    $approve_liquidation_request = $object->update_with_one_param('liquidated_investments_tbl','investment_id',$investment_id,'process_status', 3);
    $approve_liquidation_request_decode = json_decode($approve_liquidation_request, true);
    if($approve_liquidation_request_decode['status'] == 0){
    	echo "error";
    }else{
    	echo "success";
        $object->insert_logs($_SESSION['adminid'], 'Rejected Liquidation request');
        $object->insert_into_notifications_tbl($notification_type, $get_user_id['user_id'], $notification_heading, $notification);
    }
?>