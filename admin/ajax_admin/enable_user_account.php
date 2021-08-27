<?php session_start();
    require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    $unique_id = $_POST['user_id'];
    $object = new DbQueries();
    $table = 'users_tbl';
    $param = 'unique_id';
    $value = $unique_id;
    $new_value_param = 'access_level';
    $new_value = 1;
    $subject = "Account Reactivation - FarmKonnect";
    $content = "Your account has been enabled, thanks for bearing with us.
    Thanks, Regards";
    $get_user_email = $object->get_one_row_from_one_table('users_tbl', 'unique_id', $unique_id);
    $user_email = $get_user_email['email'];
    $enable_user_account = $object->update_with_one_param($table,$param,$value,$new_value_param,$new_value);
    $enable_user_account_decode = json_decode($enable_user_account, true);
    if($enable_user_account_decode['status'] == 0){
        echo "error";
    }else{
        echo "success";
        $object->insert_logs($_SESSION['adminid'], "Enabled a user's account");
        $object->email_function($user_email, $subject, $content);
        //$object->insert_into_notifications_tbl($notification_type, $user_id, $notification_heading, $notification);
    }
?>