<?php
session_start();
require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    $probation_target = $_POST['sales_target'];
    $admin_id = $_SESSION['adminid'];
    //print_r($_POST);
    $object = new DbQueries();
    $insert_probation_target = $object->set_probation_target($probation_target, $admin_id);
    $insert_probation_target_decode = json_decode($insert_probation_target, true);
    if($insert_probation_target_decode['status'] == 0){
    echo $insert_probation_target_decode['msg'];
    }else{
    	echo "success";
    	$description = "Set Probation Target for New Business Executives";
		$object->insert_logs($admin_id, $description);
    }
 ?>