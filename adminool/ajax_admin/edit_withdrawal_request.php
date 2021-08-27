<?php
session_start();
require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    $status = $_POST['status'];
    $request_id = $_POST['request_id'];
    $assigned_by = $_SESSION['adminid'];
    //print_r($_POST);
    $object = new DbQueries();
    $update_processing_status = $object->update_with_one_param('debit_wallet_tbl', 'unique_id',$request_id,'processing_status',$status);
    $update_processing_status_decode = json_decode($update_processing_status, true);
    if($update_processing_status_decode['status'] == 0){
    echo 500;
    }else{
    	echo 200;
    	$description = "Updated the status of a complaint ";
		$object->insert_logs($assigned_by, $description);
    }
 ?>