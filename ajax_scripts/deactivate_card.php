<?php
    // session_start();
    // require_once('../classes/db_class.php');
    // require_once('../includes/config.php');
require_once('../includes/instantiated_files3.php');
    $table = 'access_card_tbl';
    $param = 'user_id';
    $value = $_SESSION['uid'];
    $new_value_param = 'card_status';
    $new_value = 4;
    $object = new DbQueries();
    $subject = "Access Card Deactivation - FarmKonnect";
    $content = "You have successfully deactivated your access card
    Thanks, Regards";
    $notification_type = 'alert';
    $notification_heading = 'Access Card Deactivation';
    $notification = 'You deactivated your Access Card';
    $update_card_status = $object->update_with_one_param($table,$param,$value,$new_value_param,$new_value);
    $update_card_status_decode = json_decode($update_card_status, true);
    if($update_card_status_decode['status']== 0){
        echo "error";
    }else{
        echo "success";
        $object->insert_into_notifications_tbl($notification_type, $_SESSION['uid'], $notification_heading, $notification);
        $object->email_function($email, $subject, $content);
        $object->insert_users_logs($_SESSION['uid'], 'Deactivated Access Card');
    }
?>