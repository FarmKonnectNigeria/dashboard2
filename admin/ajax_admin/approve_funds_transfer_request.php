<?php session_start();
    require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    $unique_id = $_POST['unique_id'];
    $object = new DbQueries();
    $table = 'wallet_tbl';
    $param = 'unique_id';
    $value = $unique_id;
    $new_value_param = 'transfer_access';
    $new_value = 2;
    $transfer_pin = rand(1000, 9999);

    $approve_request = $object->update_with_one_param($table,$param,$value,$new_value_param,$new_value);

    $update_transfer_pin = $object->update_with_one_param($table,$param,$value,'transfer_pin', $transfer_pin);

    $get_user_id =$object->get_one_row_from_one_table($table,'unique_id',$unique_id);
    $user_id = $get_user_id['user_id'];

    $get_user_email = $object->get_one_row_from_one_table('users_tbl','unique_id',$user_id);
    $user_email = $get_user_email['email'];

    $subject = 'Funds Transfer Request Activation - FarmKonnect';
    $content = 'Your funds transfer activation request has been granted and your activation pin is '.$get_user_id['transfer_pin'].'. Please keep this pin as you will be asked to provide it whenever you want to do wallet to wallet transfer
    Thanks, Regards.';
    $notification_type = 'alert';
    $notification_heading = 'Funds Transfer Request Activation';
    $notification = 'Your funds transfer activation request has been granted and your activation pin is '.$get_user_id['transfer_pin'];

    $approve_request_decode = json_decode($approve_request, true);

    if($approve_request_decode['status'] == 0){
        echo "error";
    }else{
        echo "success";
        $object->insert_logs($_SESSION['adminid'], 'Approved funds transfer request');
        $object->email_function($user_email, $subject, $content);
        $object->insert_into_notifications_tbl($notification_type, $user_id, $notification_heading, $notification);
    }
?>