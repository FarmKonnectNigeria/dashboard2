<?php
include("../includes/session.php");
require_once("../classes/db_class.php");
require_once('db_connect.php');
include("../includes/config.php");
include("api_auth.php");
header('Content-Type: application/json');
$object = new DbQueries;
$table = 'wallet_tbl';
    $param = 'user_id';
    $new_value_param = 'transfer_access';
    $new_value = 1;
    $subject = "Funds Transfer Activation - FarmKonnect";
    $content = "You have successfully sent a request to activate funds transfer, you will be notified as soon as your request is accepted
    Thanks, Regards.";
    $notification_type = 'alert';
    $notification_heading = 'Funds Transfer Activation';
    $notification = 'Hello, you just sent a request to activate funds transfer, you will be notified as soon as your request is approved';
    $user_id = $_POST['uid'];
    if(!isset($_POST['uid'])){
        echo json_encode(["status"=>"0", "msg"=>"empty_fields"]);
    }else{
        $value = $_POST['uid'];
    $update_transfer_access = $object->update_with_one_param($table,$param,$value,$new_value_param,$new_value);
    $update_transfer_access_decode = json_decode($update_transfer_access, true);
    if($update_transfer_access_decode['status'] == '0'){
        echo json_encode(["status"=>"0", "msg"=>"db_error"]);
    }
    else{
        echo json_encode(["status"=>"1", "msg"=>"success"]);
        $object->email_function($email, $subject, $content);
        $object->insert_into_notifications_tbl($notification_type, $user_id, $notification_heading, $notification);
    }
}

?>