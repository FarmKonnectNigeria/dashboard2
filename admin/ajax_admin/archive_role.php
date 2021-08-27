<?php
session_start();
require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    $role_id = $_POST['role_id'];
     $assigned_by = $_SESSION['adminid'];
    //print_r($_POST);
    $object = new DbQueries();
    $archive_role = $object->update_with_one_param('admin_roles','unique_id',$role_id,'status',0);
    $archive_role_decode = json_decode($archive_role, true);
    if($archive_role_decode['status'] == 0){
    echo 500;
    }else{
        echo 200;
        $description = "Archived a role";
        $object->insert_logs($assigned_by, $description);
    }
 ?>