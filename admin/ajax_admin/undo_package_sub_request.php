<?php
 include('../includes/instantiated_files.php');
 require_once('../../classes/algorithm_functions.php');
 $investment_id = $_POST['id'];
 $description = $_POST['description'];
$admin_id = $_SESSION['adminid'];
 $submit_undo_package_request = submit_undo_package_request($admin_id, $investment_id, $description);
    $submit_undo_package_request_decode = json_decode($submit_undo_package_request, true);
    if($submit_undo_package_request_decode['status'] == 0){
    	echo $submit_undo_package_request_decode['msg'];
    }else{
    	echo "success";
        $object->insert_logs($_SESSION['adminid'], 'Requested for package unsubscription');
    }
?>