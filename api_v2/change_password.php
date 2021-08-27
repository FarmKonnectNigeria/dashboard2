<?php
include("../includes/session.php");
require_once("../classes/db_class.php");
require_once('db_connect.php');
include("../includes/config.php");
include("api_auth.php");
header('Content-Type: application/json');
$object = new DbQueries;
    $password = $_POST['password'];

    $hash = md5($password);

    $confirm_password = $_POST['confirm_password'];
    $old_password = $_POST['old_password'];
    $hash_old_password = md5($old_password);

    $uid = $_POST['uid'];

    $notification_type = 'update';
    $notification_heading = 'Password Update';
    $notification = 'You updated your password';
    $get_user = $object->get_one_row_from_one_table('users_tbl', 'unique_id', $uid);

    if(empty($password) || empty($confirm_password) || empty($old_password)){
        echo json_encode(["status"=>0, "msg"=>"empty_fields"]);
    }
    else if($get_user['password'] != $hash_old_password){
        echo json_encode(["status"=>0, "msg"=>"incorrect_old_password"]);
    }

    else if ($password != $confirm_password){
        echo json_encode(["status"=>0, "msg"=>"passwords_do_not_match"]);
    }else{
    $update_password = $object->update_with_one_param('users_tbl', 'unique_id', $uid, 'password', $hash);

    $update_password_decode = json_decode($update_password, true);
    if($update_password_decode['status'] == 0){
        echo json_encode(["status"=>0, "msg"=>"db_error"]);
    }
    else{
    	echo json_encode(["status"=>1, "msg"=>"success"]);;  
        $object->insert_into_notifications_tbl($notification_type, $uid, $notification_heading, $notification);  
        $object->insert_users_logs($uid, 'Changed Password');
    }

}
 ?> 