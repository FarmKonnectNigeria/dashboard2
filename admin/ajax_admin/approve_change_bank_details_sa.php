<?php
 include('../includes/instantiated_files.php');
 $unique_id = $_POST['unique_id'];
 $approve_request = $object->approve_change_bank_details($unique_id);
    $approve_request_decode = json_decode($approve_request, true);
    if($approve_request_decode['status'] == 0){
    	echo "error";
    }else{
    	echo "success";
        $object->insert_logs($_SESSION['adminid'], "Approved change of user's bank details");
    }
?>