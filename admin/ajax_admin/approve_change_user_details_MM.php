<?php
 include('../includes/instantiated_files.php');
 $unique_id = $_POST['unique_id'];
 $approve_request = $object->update_with_one_param('edit_sensitive_details_log','unique_id',$unique_id,'status', 2);
    $approve_request_decode = json_decode($approve_request, true);
    if($approve_request_decode['status'] == 0){
    	echo "error";
    }else{
    	echo "success";
        $object->insert_logs($_SESSION['adminid'], "Approved change of user's detail");
    }
?>