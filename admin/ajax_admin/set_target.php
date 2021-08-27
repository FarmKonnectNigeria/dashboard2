<?php
session_start();
require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    $sales_target = $_POST['sales_target'];
    $admin_id = $_SESSION['adminid'];
    //print_r($_POST);
    $object = new DbQueries();
    $insert_target = $object->set_target($sales_target, $admin_id);
    $insert_target_decode = json_decode($insert_target, true);
    if($insert_target_decode['status'] == 0){
    echo $insert_target_decode['msg'];
    }else{
    	echo "success";
    	$description = "Set Target for Business Executives";
		$object->insert_logs($admin_id, $description);
    }
 ?>