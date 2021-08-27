<?php session_start();
    require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    $sender_id = $_POST['sender_id'];
    $beneficiary_id = $_POST['beneficiary_id'];
    $amount_sent = $_POST['amount_sent'];
    $admin_id = $_SESSION['adminid'];
    $unique_id = $_POST['unique_id'];
    //print_r($_POST);
    $subject = "Transfer Funds approval - FarmKonnect";

    $object = new DbQueries();
    $get_sender_email = $object->get_one_row_from_one_table('users_tbl','unique_id',$sender_id);
    $sender_email = $get_sender_email['email'];
    $sender_name = $get_sender_email['surname'].' '.$get_sender_email['other_names'];
     $get_beneficiary_email = $object->get_one_row_from_one_table('users_tbl','unique_id',$beneficiary_id);
    $beneficiary_email = $get_beneficiary_email['email'];
    $beneficiary_name = $get_beneficiary_email['surname'].' '.$get_beneficiary_email['other_names'];
     $content1 = "You have successfully transfered ".$amount_sent. " to " .$beneficiary_name. "
    Thanks, Regards";
    $content2 = "Your wallet has been credited with ".$amount_sent. " by " .$sender_name. "
    Thanks, Regards";
    $notification_type = 'alert';
    $notification_heading = 'Inter-Wallet Transfer';
    $notification1 = 'You transfered '.$amount_sent. ' to ' .$beneficiary_name;
    $notification2 = 'Your wallet was credited with '.$amount_sent. ' by ' .$sender_name;

    $approve_pending_transfer = $object->approve_pending_transfers($sender_id, $amount_sent, $beneficiary_id);
    $approve_pending_transfer_decode = json_decode($approve_pending_transfer, true);
    if($approve_pending_transfer_decode['status'] ==  0){
        echo 500;
    }else{
        $object->update_with_one_param('transfer_log','unique_id',$unique_id,'transfer_status',1);
        echo 200;
    $object->insert_logs($admin_id, 'Approved pending transfer');
    $object->email_function($beneficiary_email, $subject, $content2);
    $object->email_function($sender_email, $subject, $content1);

    $object->insert_into_notifications_tbl($notification_type, $sender_id, $notification_heading, $notification1);
    $object->insert_into_notifications_tbl($notification_type, $beneficiary_id, $notification_heading, $notification2);

    }
?>