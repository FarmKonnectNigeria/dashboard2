<?php
session_start();
require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    require_once('../../classes/algorithm_functions.php');
    $object = new DbQueries();
    @$client_id = $_POST['clients'];
    $transfer_to = $_POST['BE_name'];
    $time_frame = $_POST['time_frame'];
    $BE_id = $_SESSION['adminid'];
    $get_BE=$object->get_one_row_from_one_table('admin_tbl', 'unique_id', $BE_id);
    $get_transfer_to=$object->get_one_row_from_one_table('admin_tbl', 'unique_id', $transfer_to);
    $notification_type = 'alert';
    $notification_heading = 'Client Transfer';
    $notification = "Your Business Executive, ".$get_BE['surname']." ".$get_BE['other_names']." transfered his clients to ".$get_transfer_to['surname']." ".$get_transfer_to['other_names']." for ".$time_frame." day(s)";
    //print_r($_POST);
    $transfer_client = $object->transfer_client_temporarily($BE_id, $client_id, $transfer_to, $time_frame);
    $transfer_client_decode = json_decode($transfer_client, true);
    if($transfer_client_decode['status'] == 0){
    echo $transfer_client_decode['msg'];
    }else{
    	echo "success";
    	$description = "Transferred a Client";
		$object->insert_logs($BE_id, $description);
        $get_MM_id = $object->get_one_row_from_one_table('business_executive_tbl', 'unique_id', $BE_id);
        insert_into_admin_notifications_tbl($notification_type, $get_MM_id['assigned_to'], $notification_heading, $notification);
    }
 ?>