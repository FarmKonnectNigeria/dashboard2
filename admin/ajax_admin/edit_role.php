<?php
session_start();
require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    @$function_id = $_POST['functions'];
    @$page_id = $_POST['pages'];
    $role_id = $_POST['role_id'];
    $assigned_by = $_SESSION['adminid'];
    //print_r($_POST);
    $object = new DbQueries();
    $update_role = $object->update_role($role_id, $function_id, $page_id);
    $update_role_decode = json_decode($update_role, true);
    if($update_role_decode['status'] == 0){
    echo 500;
    }else{
    	echo 200;
    	$description = "Updated a new role";
		$object->insert_logs($assigned_by, $description);
    }
 ?>