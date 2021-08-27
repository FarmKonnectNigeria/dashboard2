<?php session_start();
    require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    $unique_id = $_POST['unique_id'];
    $object = new DbQueries();
    $table = 'wallet_tbl';
    $param = 'unique_id';
    $value = $unique_id;
    $new_value_param = 'transfer_access';
    $new_value = 3;
     $subject = "Inter-Wallet Transfer - FarmKonnect";
    $content = "Your request to activate inter-wallet transfer has been rejected. Please contact FarmKonnect for more details.
    Thanks, Regards";
    $get_user_id = $object->get_one_row_from_one_table('wallet_tbl', 'unique_id', $unique_id);
    $user_id = $get_user_id['user_id'];
     $get_user_email = $object->get_one_row_from_one_table('users_tbl', 'unique_id', $user_id);
    $user_email = $get_user_email['email'];
    $notification_type = 'alert';
    $notification_heading = 'Inter-Wallet Transfer';
    $notification = 'Hello, your request to activate inter-wallet transfer has been rejected';
    $reject_ = $object->update_with_one_param($table,$param,$value,$new_value_param,$new_value);
    $reject__decode = json_decode($reject_, true);
    if($reject__decode['status'] == 0){
        echo "error";
    }else{
        echo "success";
        $object->insert_logs($_SESSION['adminid'], 'Rejected funds transfer request');
        $object->email_function($user_email, $subject, $content);
        $object->insert_into_notifications_tbl($notification_type, $user_id, $notification_heading, $notification);
    }
?>