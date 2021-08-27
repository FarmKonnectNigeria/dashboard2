<?php
 include('../includes/instantiated_files.php');
 require_once('../../classes/algorithm_functions.php');
 $unit_id = $_POST['unit_id'];
 $user_id = $_POST['user_id'];
$admin_id = $_SESSION['adminid'];
 $unassign_user_to_unit = unassign_user_to_unit($unit_id, $user_id);
    $unassign_user_to_unit_decode = json_decode($unassign_user_to_unit, true);
    if($unassign_user_to_unit_decode['status'] == 0){
    	echo $unassign_user_to_unit_decode['msg'];
    }else{
    	echo "success";
        $object->insert_logs($admin_id, 'Assigned user(s) to CCTV unit');
    }
?>