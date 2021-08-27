<?php
    include('../includes/instantiated_files.php');
    $unique_id = $_POST['unique_id'];
    $reject_request = $object->update_with_one_param('package_category_request','unique_id',$unique_id,'approval_status', 2);
    $reject_request_decode = json_decode($reject_request, true);
    if($reject_request_decode['status'] == 0){
    	echo "error";
    }else{
    	echo "success";
        $object->insert_logs($_SESSION['adminid'], 'Rejected Package Category Creation');
    }
?>