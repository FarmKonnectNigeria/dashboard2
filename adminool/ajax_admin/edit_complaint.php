<?php
session_start();
require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    $status = $_POST['status'];
    $complaint_id = $_POST['complaint_id'];
    $assigned_by = $_SESSION['adminid'];
    //print_r($_POST);
    $object = new DbQueries();
    $update_complaint = $object->update_with_one_param('contact_us_tbl', 'unique_id',$complaint_id,'status',$status);
    $update_complaint_decode = json_decode($update_complaint, true);
    if($update_complaint_decode['status'] == 0){
    echo 500;
    }else{
    	echo 200;
    	$description = "Updated the status of a complaint ";
		$object->insert_logs($assigned_by, $description);
    }
 ?>