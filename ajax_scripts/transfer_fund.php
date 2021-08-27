<?php
    require_once('../includes/instantiated_files3.php');
    $beneficiary_email = $_POST['beneficiary'];
    $amount = $_POST['amount'];
    $transfer_pin = $_POST['transfer_pin'];
    $user_id = $uid;
    //$object = new DbQueries();
    $get_beneficairy_id = $object->get_one_row_from_one_table('users_tbl','email',$beneficiary_email);
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
    echo $update_wallet_decode['msg'];
    if($update_wallet_decode['msg']  == 'success'){
        $object->email_function($email,$subject,$content);
        $object->email_function($beneficiary_email,$subject,$content2);
        $object->insert_into_notifications_tbl($notification_type, $uid, $notification_heading, $notification);
        $object->insert_into_notifications_tbl($notification_type, $beneficiary_id, $notification_heading, $notification2);
        $object->insert_users_logs($_SESSION['uid'], 'Transfered funds to '.$beneficiary_email);
    }
?>