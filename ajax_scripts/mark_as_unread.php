<?php
header('content-type: text/json');
require_once('../includes/instantiated_files3.php');
    $unique_id = $_POST['unique_id'];
    $response = array();
    $object = new DbQueries();
    $update_notification_status = $object->update_with_one_param('notifications_tbl','unique_id', $unique_id, 'status', 0);
    $update_notification_status_decode = json_decode($update_notification_status, true);
    $get_notifications_number = $object->get_number_of_rows_two_params('notifications_tbl','user_id',$uid,'status', 0);
    if($update_notification_status_decode['status']== 0){
        $response['status'] = 'error';
    }else{
        $response['status'] = 'success';
        $response['message'] = $get_notifications_number;
    }
    echo json_encode($response);
?>