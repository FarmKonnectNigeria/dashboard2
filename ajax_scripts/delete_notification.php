<?php
require_once('../includes/instantiated_files3.php');
$notification_id = $_POST['unique_id'];
$delete_notification = $object->delete_a_row('notifications_tbl','unique_id',$notification_id);
if($delete_notification){
 echo "success";
}else{
 echo "error";
}
?>