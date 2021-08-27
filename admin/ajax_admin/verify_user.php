<?php session_start();
    require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    $unique_id = $_POST['unique_id'];
    $object = new DbQueries();
    $table = 'users_tbl';
    $param = 'unique_id';
    $value = $unique_id;
    $new_value_param = 'verification_status';
    $new_value = 1;
    $subject = "Account Verification - FarmKonnect";
    $content = "Congratulations! Your FarmKonnect account has been verified.
    Thanks, Regards";
    $get_user_id = $object->get_one_row_from_one_table('users_tbl', 'unique_id', $unique_id);
    $user_email = $get_user_id['email'];
    $notification_type = 'alert';
    $notification_heading = 'Account Verification';
    $notification = 'Congratulations! Your FarmKonnect account has been verified';
    $verify_user = $object->update_with_one_param($table,$param,$value,$new_value_param,$new_value);
    $verify_user_decode = json_decode($verify_user, true);
    if($verify_user_decode['status'] == 0){
        echo "error";
    }else{
        echo "success";
        $object->insert_logs($_SESSION['adminid'], 'Verified a User');
        $object->insert_into_notifications_tbl($notification_type, $unique_id, $notification_heading, $notification);
    }
?>