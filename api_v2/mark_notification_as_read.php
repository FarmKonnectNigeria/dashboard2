<?php
include("../includes/session.php");
require_once("../classes/db_class.php");
require_once('db_connect.php');
include("../includes/config.php");
include("api_auth.php");
header('Content-Type: application/json');
$object = new DbQueries;
$uid = $_GET['uid'];
$update_notification_status = $object->update_with_one_param('notifications_tbl','user_id', $uid, 'status', 1);
$update_notification_status_decode = json_decode($update_notification_status, true);
if($update_notification_status_decode['status']== 0){
    echo json_encode(["status"=>"0", "msg"=>"error"]);
}else{
    echo json_encode(["status"=>"1", "msg"=>"success"]);
}
?>