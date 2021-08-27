<?php
session_start();
require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    $role_name = $_POST['role_name'];
    $role_description = $_POST['role_description'];
    $function_id = $_POST['functions'];
    $assigned_by = $_SESSION['adminid'];
    $page_ids = $_POST['pages'];
    //print_r($_POST);
    $object = new DbQueries();
    $insert_role = $object->add_role($role_name, $role_description, $function_id, $assigned_by, $page_ids);
    $insert_role_decode = json_decode($insert_role, true);
    if($insert_role_decode['status'] == 0){
    echo $insert_role_decode['msg'];
    }else{
    	echo "success";
    	$description = "Added a new role";
		$object->insert_logs($assigned_by, $description);
    }
 ?>