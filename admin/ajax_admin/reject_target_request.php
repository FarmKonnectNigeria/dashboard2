<?php session_start();
    require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    $unique_id = $_POST['unique_id'];
    $object = new DbQueries();
    $approve_request = $object->update_with_one_param('target_request','unique_id',$unique_id,'target_status', 3);
    $approve_request_decode = json_decode($approve_request, true);
    if($approve_request_decode['status'] == 0){
    	echo "error";
    }else{
    	   echo "success";
        $object->insert_logs($_SESSION['adminid'], 'Rejected BE Target Adjustment');
    }
?>