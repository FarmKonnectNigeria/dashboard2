<?php
    // session_start();
    // require_once('../classes/db_class.php');
    // require_once('../includes/config.php');
require_once('../includes/instantiated_files3.php');
    $user_id = $_SESSION['uid'];
    $object = new DbQueries();
    $subject = "Access Card Request - FarmKonnect";
    $content = "You have placed a request for your access card, please note that the processing may take up to 48 hours please kindly bear with us
    Thanks, Regards";
    $notification_type = 'alert';
    $notification_heading = 'Access Card Request';
    $notification = 'You placed a request for your access card';
    $insert_request = $object->insert_into_access_tbl($user_id);
    $insert_request_decode = json_decode($insert_request, true);
    echo $insert_request_decode['msg'];
    if($insert_request_decode['msg'] == 'success'){
        $object->email_function($email, $subject, $content);
        $object->insert_into_notifications_tbl($notification_type, $user_id, $notification_heading, $notification);
        $object->insert_users_logs($_SESSION['uid'], 'Requested for Access Card Activation');
    }
 ?>