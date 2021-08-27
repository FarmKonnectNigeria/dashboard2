<?php
 include('../includes/instantiated_files.php');
 require_once('../../classes/algorithm_functions.php');
 $unit_id = $_POST['unit_id'];
 $user_id = $_POST['user_id'];
$admin_id = $_SESSION['adminid'];
 $assign_user_to_unit = assign_user_to_unit($unit_id, $user_id, $admin_id);
    $assign_user_to_unit_decode = json_decode($assign_user_to_unit, true);
    if($assign_user_to_unit_decode['status'] == 0){
    	echo $assign_user_to_unit_decode['msg'];
    }else{
    	echo "success";
        $object->insert_logs($admin_id, 'Assigned user(s) to CCTV unit');
    }
?>