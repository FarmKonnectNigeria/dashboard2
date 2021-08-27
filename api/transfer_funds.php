<?php
include("../includes/session.php");
require_once("../classes/db_class.php");
require_once('db_connect.php');
include("../includes/config.php");
header('Content-Type: application/json');
$object = new DbQueries;
    $user_id = $_POST['sender_id'];
    $amount = isset($_POST['amount']) ? $_POST['amount'] : '';
    $beneficiary_email = isset($_POST['beneficiary_email']) ? $_POST['beneficiary_email'] : '';
    $get_beneficairy_id = $object->get_one_row_from_one_table('users_tbl','email',$beneficiary_email);
    $get_sender_name = $object->get_one_row_from_one_table('users_tbl','unique_id',$user_id);
    $fullname_user =$get_sender_name['surname'].' '.$get_sender_name['other_names'];
    $beneficiary_id = $get_beneficairy_id['unique_id'];
    $transfer_pin = isset($_POST['transfer_pin']) ? $_POST['transfer_pin'] : '';
    $get_verification_status = $object->get_one_row_from_one_table('users_tbl', 'unique_id', $user_id);
    $verification_status = $get_verification_status['verification_status'];
    $beneficiary_id = $get_beneficairy_id['unique_id'];
    $beneficiary_name = $get_beneficairy_id['surname'].' '.$get_beneficairy_id['other_names'];
    $subject = "Funds Transfer - FarmKonnect";
    $content = "Transaction successful! You transfered ".$amount. " to " .$beneficiary_name.
    "Thanks, Regards";
    $content2 = $amount." was transfered to you from ".$fullname_user.
    "Thanks, Regards";
    $notification_type = 'alert';
    $notification_heading = 'Inter-Wallet Transfer';
    $notification = 'You transfered '.$amount.' to '.$beneficiary_name;
    $notification2 = $amount.' was transfered to you from '.$fullname_user;
    $update_wallet = $object->transfer_to_wallet($user_id, $amount, $beneficiary_id, $beneficiary_email, $transfer_pin, $verification_status);
    $update_wallet_decode = json_decode($update_wallet, true);
    //echo $update_wallet_decode['msg'];
    if($update_wallet_decode['msg'] == "empty_fields"){
        echo  json_encode(["status"=>"0", "msg"=>"empty_fields"]);
    }
    else if($update_wallet_decode['msg'] == "wallet_deactivated"){
         echo json_encode(["status"=>"9", "msg"=>"wallet_deactivated"]);
    }
    else if($update_wallet_decode['msg'] == "user_does_not_exist"){
        echo json_encode(["status"=>"2", "msg"=>"user_does_not_exist"]);
    }
    else if($update_wallet_decode['msg'] == "balance_less"){
         echo json_encode(["status"=>"3", "msg"=>"balance_less"]);
    }
    else if($update_wallet_decode['msg'] == "incorrect_transfer_pin"){
        echo json_encode(["status"=>"4", "msg"=>"incorrect_transfer_pin"]);
    }
    else if($update_wallet_decode['msg'] == "error_creating_transfer_log"){
        echo  json_encode(["status"=>"5", "msg"=>"error_creating_transfer_log"]);
    }
    else if($update_wallet_decode['msg'] == "success_creating_log"){
        echo json_encode(["status"=>"6", "msg"=>"success_creating_log"]);
        $object->email_function($email,$subject,$content);
        $object->email_function($beneficiary_email,$subject,$content2);
        $object->insert_into_notifications_tbl($notification_type, $user_id, $notification_heading, $notification);
        $object->insert_into_notifications_tbl($notification_type, $beneficiary_id, $notification_heading, $notification2);
        $object->insert_users_logs($user_id, 'Transfered funds to '.$beneficiary_email);
    }
    else if($update_wallet_decode['msg'] == "error"){
        echo json_encode(["status"=>"8", "msg"=>"error"]);
    }
    else if($update_wallet_decode['msg']  == 'success'){
        echo json_encode(["status"=>"1", "msg"=>"success"]);
        $object->email_function($email,$subject,$content);
        $object->email_function($beneficiary_email,$subject,$content2);
        $object->insert_into_notifications_tbl($notification_type, $user_id, $notification_heading, $notification);
        $object->insert_into_notifications_tbl($notification_type, $beneficiary_id, $notification_heading, $notification2);
        $object->insert_users_logs($user_id, 'Transfered funds to '.$beneficiary_email);
    }
    else{
        echo json_encode(["status"=>"0", "msg"=>"something_went_wrong"]);
    }

?>