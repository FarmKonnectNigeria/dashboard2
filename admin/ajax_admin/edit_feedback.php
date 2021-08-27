<?php
session_start();
require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    require_once('../../classes/algorithm_functions.php');
    $status = $_POST['status'];
    $feedback_id = $_POST['feedback_id'];
    $assigned_by = $_SESSION['adminid'];
    if($status == 1){
        $new_stat = "escalated";
    }else if($status == 2){
        $new_stat="noted";
    }
    //print_r($_POST);
    $notification_type = 'alert';
    $notification_heading = 'Feedback';
    $notification = 'Your feedback has been '.$new_stat;
    $object = new DbQueries();
    $update_feedback = $object->update_with_one_param('feedback_tbl', 'unique_id',$feedback_id,'status',$status);
    $update_feedback_decode = json_decode($update_feedback, true);
    if($update_feedback_decode['status'] == 0){
    echo 500;
    }else{
    	echo 200;
    	$description = "Updated the status of a feedback ";
		$object->insert_logs($assigned_by, $description);
        $get_user_id = $object->get_one_row_from_one_table('feedback_tbl', 'unique_id', $feedback_id);
        $object->insert_into_notifications_tbl($notification_type, $get_user_id['user_id'], $notification_heading, $notification);
    }
 ?>