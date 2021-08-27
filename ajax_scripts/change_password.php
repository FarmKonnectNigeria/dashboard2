<?php
require_once('../includes/instantiated_files3.php');
    $object = new DbQueries();
    $password = $_POST['password'];

    $hash = md5($password);

    $confirm_password = $_POST['confirm_password'];
    $old_password = $_POST['old_password'];
    $hash_old_password = md5($old_password);

    $uid = $_SESSION['uid'];

    $notification_type = 'update';
    $notification_heading = 'Password Update';
    $notification = 'You updated your password';
    $get_user = $object->get_one_row_from_one_table('users_tbl', 'unique_id', $uid);

    if(empty($password) || empty($confirm_password) || empty($old_password)){
        echo 400;
    }
    if($get_user['password'] != $hash_old_password){
        echo 600;
    }

    else if ($password != $confirm_password){
        echo 300;
    }else{
    $update_password = $object->update_with_one_param('users_tbl', 'unique_id', $uid, 'password', $hash);

    $update_password_decode = json_decode($update_password, true);
    if($update_password_decode['status'] == 0){
    echo 500;
    }
    else{
    	echo 200;  
        $object->insert_into_notifications_tbl($notification_type, $uid, $notification_heading, $notification);  
        $object->insert_users_logs($_SESSION['uid'], 'Changed Password');
    }

}
 ?> 