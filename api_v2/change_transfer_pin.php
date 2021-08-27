<?php
include("../includes/session.php");
require_once("../classes/db_class.php");
require_once("../classes/algorithm_functions.php");
require_once('db_connect.php');
include("../includes/config.php");
include("api_auth.php");
header('Content-Type: application/json');
$object = new DbQueries;
    $new_pin = $_POST['new_pin'];
    $old_pin = $_POST['old_pin'];
    $confirm_new_pin = $_POST['confirm_new_pin'];
    $user_id = $_POST['uid'];

    $notification_type = 'update';
    $notification_heading = 'Inter-wallet Transfer Pin Update';
    $notification = 'You updated your inter-wallet-transfer pin';
    $update_pin = change_transfer_pin($user_id, $new_pin, $old_pin, $confirm_new_pin);

    $update_pin_decode = json_decode($update_pin, true);
    if($update_pin_decode['status'] == 0){
        echo json_encode(["status"=>0, "msg"=>$update_pin_decode['msg']]);
    }
    else{
    	echo json_encode(["status"=>1, "msg"=>"success"]);
        $object->insert_into_notifications_tbl($notification_type, $uid, $notification_heading, $notification);  
        $object->insert_users_logs($user_id, 'Changed Inter-wallet Transfer Pin');
    }
 ?> 