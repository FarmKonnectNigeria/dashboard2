<?php
 include('../includes/instantiated_files.php');
 //require_once('../../classes/algorithm_functions.php');
 $unique_id = $_POST['unique_id'];
 $get_category_details = $object->get_one_row_from_one_table('package_category_request', 'unique_id', $unique_id);
 $name = $get_category_details['name'];
 $description = $get_category_details['description'];
 $created_by = $get_category_details['created_by'];

 $approve_category_creation = $object->insert_package_category($name, $description,$created_by);

    $approve_category_creation_decode = json_decode($approve_category_creation, true);
    if($approve_category_creation_decode['status'] == 0){
    	echo $approve_category_creation_decode['msg'];
    }else{
    	$update_approval_status = $object->update_with_one_param('package_category_request','unique_id',$unique_id,'approval_status', 1);
    	$update_approval_status_decode = json_decode($update_approval_status, true);
    	if($update_approval_status_decode['status'] == 1){
	    	echo "success";
	        $object->insert_logs($_SESSION['adminid'], 'Approved Package Category Creation');
    	}
    }
?>