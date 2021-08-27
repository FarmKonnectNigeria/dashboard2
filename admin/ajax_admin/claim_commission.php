<?php
session_start();
require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    $unique_id = $_POST['unique_id'];
    $assigned_by = $_SESSION['adminid'];
    //print_r($_POST);
    $object = new DbQueries();
    $claim_commission = $object->update_with_one_param('be_sales', 'unique_id',$unique_id,'commission_status', 1);
    $claim_commission_decode = json_decode($claim_commission, true);
    if($claim_commission_decode['status'] == 0){
    echo "error";
    }else{
    	echo "success";
    	$description = "Sent a request to claim commission ";
		$object->insert_logs($assigned_by, $description);
    }
 ?>