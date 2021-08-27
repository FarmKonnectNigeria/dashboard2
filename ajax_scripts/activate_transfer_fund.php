<?php
    // session_start();
    // require_once('../classes/db_class.php');
    // require_once('../includes/config.php');
    require_once('../includes/instantiated_files3.php');
    $table = 'wallet_tbl';
    $param = 'user_id';
    $value = $_SESSION['uid'];
    $new_value_param = 'transfer_access';
    $new_value = '1';
    $subject = "Funds Transfer Activation - FarmKonnect";
    $content = "You have successfully sent a request to activate funds transfer, you will be notified as soon as your request is approved
    Thanks, Regards.";
    $notification_type = 'alert';
    $user_id = $_SESSION['uid'];
    $notification_heading = 'Funds Transfer Activation';
    $notification = 'Hello, you just sent a request to activate funds transfer, you will be notified as soon as your request is approved';
    $object = new DbQueries();
    if(isset($_POST['terms_conditions'])){
        $update_transfer_access = $object->update_with_one_param($table,$param,$value,$new_value_param,$new_value);
        $update_transfer_access_decode = json_decode($update_transfer_access, true);
        if($update_transfer_access_decode['status'] == '0'){
            echo "error";
        }

        else{
            echo "success";
            $object->email_function($email, $subject, $content);
            $object->insert_users_logs($_SESSION['uid'], 'Requested Funds Transfer Activation');
            $object->insert_into_notifications_tbl($notification_type, $user_id, $notification_heading, $notification);
        }
    } else{
        echo "error";
    }
?>