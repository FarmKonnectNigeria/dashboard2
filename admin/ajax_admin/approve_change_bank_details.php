<?php
 include('../includes/instantiated_files.php');
 $unique_id = $_POST['unique_id'];
 $approve_request = $object->update_with_one_param('edit_bank_details_request','unique_id',$unique_id,'status', 1);
    $approve_request_decode = json_decode($approve_request, true);
    if($approve_request_decode['status'] == 0){
    	echo "error";
    }else{
    	echo "success";
        $object->insert_logs($_SESSION['adminid'], "Approved change of user's bank detail");
    }
?>