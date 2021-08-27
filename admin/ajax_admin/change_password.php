<?php
session_start();
require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
     $object = new DbQueries();
    $password = $_POST['password'];

    $hash = md5($password);

    $confirm_password = $_POST['confirm_password'];
    $old_password = $_POST['old_password'];
    $hash_old_password = md5($old_password);

    $assigned_by = $_SESSION['adminid'];
    $get_admin = $object->get_one_row_from_one_table('admin_tbl', 'unique_id', $assigned_by);

    if(empty($password) || empty($confirm_password) || empty($old_password)){
        echo 400;
    }
    else if($get_admin['password'] != $hash_old_password){
        echo 600;
    }
    else if ($password != $confirm_password){
        echo 300;
    }else{
   
    $update_password = $object->update_with_one_param('admin_tbl', 'unique_id',$assigned_by, 'password', $hash);

    $update_password_decode = json_decode($update_password, true);
    if($update_password_decode['status'] == 0){
    echo 500;
    }
    else{
    	echo 200;
    	$description = "Changed Password";
		$object->insert_logs($assigned_by, $description);
    }
}
 ?> 