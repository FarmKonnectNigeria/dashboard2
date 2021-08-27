<?php
require_once('../includes/instantiated_files3.php');
    $user_id = $uid;
    $object = new DbQueries();
     $update_notification_status = $object->update_with_one_param('notifications_tbl','user_id', $user_id, 'status', 1);
    $update_notification_status_decode = json_decode($update_notification_status, true);
    if($update_notification_status_decode['status']== 0){
        echo "error";
    }else{
        echo "success";
    }
?>