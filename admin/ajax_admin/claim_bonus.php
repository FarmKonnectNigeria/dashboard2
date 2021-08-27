<?php
session_start();
require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    $unique_id = $_POST['unique_id'];
    $assigned_by = $_SESSION['adminid'];
    //print_r($_POST);
    $object = new DbQueries();
    $claim_bonus = $object->update_with_one_param('target_bonus_commission', 'unique_id',$unique_id,'bonus_status', 1);
    $claim_bonus_decode = json_decode($claim_bonus, true);
    if($claim_bonus_decode['status'] == 0){
    echo "error";
    }else{
    	echo "success";
    	$description = "Sent a request to claim bonus ";
		$object->insert_logs($assigned_by, $description);
    }
 ?>