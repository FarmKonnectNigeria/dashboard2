<?php
session_start();
require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    $status = $_POST['status'];
    $feedback_id = $_POST['feedback_id'];
    $assigned_by = $_SESSION['adminid'];
    //print_r($_POST);
    $object = new DbQueries();
    $update_feedback = $object->update_with_one_param('feedback_tbl', 'unique_id',$feedback_id,'status',$status);
    $update_feedback_decode = json_decode($update_feedback, true);
    if($update_feedback_decode['status'] == 0){
    echo 500;
    }else{
    	echo 200;
    	$description = "Updated the status of a feedback ";
		$object->insert_logs($assigned_by, $description);
    }
 ?>