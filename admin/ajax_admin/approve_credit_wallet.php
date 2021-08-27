<?php session_start();
    require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    $user_id = $_POST['user_id'];
    $unique_id = $_POST['unique_id'];
    $amount = $_POST['amount'];
    $admin_id = $_SESSION['adminid'];
    //print_r($_POST);
    $subject = "Credit Wallet approval - FarmKonnect";
    $content = "You have successfully credited your wallet with ".$amount;" 
    Thanks, Regards";
    $object = new DbQueries();
    $get_email = $object->get_one_row_from_one_table('users_tbl','unique_id',$user_id);
    $email = $get_email['email'];
    $approve_credit_wallet = $object->approve_credit_wallet($user_id, $amount);
    $approve_credit_wallet_decode = json_decode($approve_credit_wallet, true);
    $notification_type = 'alert';
    $notification_heading ='Credit Wallet approval';
    $notification = 'You credited your wallet with '.$amount;
    if($approve_credit_wallet_decode['status'] ==  0){
        echo 500;
    }else{
        $object->update_with_one_param('bank_transfer_tbl','unique_id',$unique_id,'payment_status',1);
        echo 200;
    $object->insert_logs($admin_id, 'Approved credit wallet');
    $object->email_function($email, $subject, $content);
    $object->insert_into_notifications_tbl($notification_type, $user_id, $notification_heading, $notification);

    }
?>