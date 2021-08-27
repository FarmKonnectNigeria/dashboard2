<?php
session_start();
require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    require_once('../../classes/algorithm_functions.php');
    $status = $_POST['status'];
    $complaint_id = $_POST['complaint_id'];
    $assigned_by = $_SESSION['adminid'];
    if($status == 1){
        $new_stat = "escalated";
    }else if($status == 2){
        $new_stat="resolved";
    }
    //print_r($_POST);
    $notification_type = 'alert';
    $notification_heading = 'Complaint';
    $notification = 'Your complaint has been '.$new_stat;
    //print_r($_POST);
    $object = new DbQueries();
    $update_complaint = $object->update_with_one_param('contact_us_tbl', 'unique_id', $complaint_id,'status',$status);
    $update_complaint_decode = json_decode($update_complaint, true);
    if($update_complaint_decode['status'] == 0){
    echo 500;
    }else{
    	echo 200;
    	$description = "Updated the status of a complaint ";
		$object->insert_logs($assigned_by, $description);
        $get_user_id = $object->get_one_row_from_one_table('contact_us_tbl', 'unique_id', $complaint_id);
        $object->insert_into_notifications_tbl($notification_type, $get_user_id['user_id'], $notification_heading, $notification);
    }
 ?>