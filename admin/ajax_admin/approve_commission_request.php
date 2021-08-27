<?php session_start();
    require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    $unique_id = $_POST['unique_id'];
    $commission = $_POST['commission'];
     $admin_id = $_POST['set_by'];
     $BE_id = $_POST['BE_id'];
    $object = new DbQueries();
    $approve_commission_request = $object->approve_commission_request($commission, $BE_id, $unique_id, $admin_id);
    $approve_commission_request_decode = json_decode($approve_commission_request, true);
    if($approve_commission_request_decode){
    	echo $approve_commission_request_decode['msg'];
    }else{
    	echo "success";
        $object->insert_logs($_SESSION['adminid'], 'Approved set Commission request');
    }
?>