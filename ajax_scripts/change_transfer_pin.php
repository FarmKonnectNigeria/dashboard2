<?php
require_once('../includes/instantiated_files3.php');
require_once('../classes/algorithm_functions.php');
    $new_pin = $_POST['new_pin'];
    $old_pin = $_POST['old_pin'];
    $confirm_new_pin = $_POST['confirm_new_pin'];
    $user_id = $_SESSION['uid'];

    $notification_type = 'update';
    $notification_heading = 'Inter-wallet Transfer Pin Update';
    $notification = 'You updated your inter-wallet-transfer pin';

    $object = new DbQueries();
    $update_pin = change_transfer_pin($user_id, $new_pin, $old_pin, $confirm_new_pin);

    $update_pin_decode = json_decode($update_pin, true);
    if($update_pin_decode['status'] == 0){
        if($update_pin_decode['msg'] == "no_transfer_pin"){
            echo 300;
        }else if($update_pin_decode['msg'] == "wrong_old_pin"){
            echo 400;
        }
        else if($update_pin_decode['msg'] == "new_pins_mismatch"){
           echo 500; 
        }
        else if($update_pin_decode['msg'] == "length_error"){
           echo 600; 
        }
        else if($update_pin_decode['msg'] == "empty_fields"){
           echo 700; 
        }
        else if($update_pin_decode['msg'] == "not_number"){
           echo 800; 
        }else{
            echo 900;
        }
    }
    else{
    	echo 200;  
        $object->insert_into_notifications_tbl($notification_type, $uid, $notification_heading, $notification);  
        $object->insert_users_logs($user_id, 'Changed Inter-wallet Transfer Pin');
    }
 ?> 