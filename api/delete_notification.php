<?php
include("../includes/session.php");
require_once("../classes/db_class.php");
require_once('db_connect.php');
include("../includes/config.php");
header('Content-Type: application/json');
$object = new DbQueries;
  $notification_id = $_GET['notification_id'];
$delete_notification = $object->delete_a_row('notifications_tbl','unique_id',$notification_id);
if($delete_notification){
 echo json_encode(["status"=>"1", "msg"=>"success"]);
}else{
  echo json_encode(["status"=>"0", "msg"=>"error"]);
}
?>