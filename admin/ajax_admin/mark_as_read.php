<?php
include('../includes/instantiated_files.php');
    $admin_id = $uid;
    $object = new DbQueries();
     $update_notification_status = $object->update_with_one_param('admin_notifications_tbl','admin_id', $admin_id, 'status', 1);
    $update_notification_status_decode = json_decode($update_notification_status, true);
    if($update_notification_status_decode['status']== 0){
        echo "error";
    }else{
        echo "success";
    }
?>