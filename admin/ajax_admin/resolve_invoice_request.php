<?php session_start();
    require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    require_once('../../classes/algorithm_functions.php');
    $unique_id = $_POST['unique_id'];
    $BE_id = $_POST['BE_id'];
    $object = new DbQueries();
    $table = 'client_invoice';
    $param = 'unique_id';
    $value = $unique_id;
    $new_value_param = 'status';
    $new_value = 2;
    $get_be_email = $object-> get_one_row_from_one_table('admin_tbl','unique_id',$BE_id);
    $email = $get_be_email['email'];
    $user_email = $_POST['email'];
    $fullname = $_POST['fullname'];
    $get_user_id = $object-> get_one_row_from_one_table('users_tbl','email',$user_email);
    $notification_type = 'alert';
    $notification_heading = 'Invoice Request';
    $notification = "The invoice request you raised for ".$fullname." has been processed successfully";
    $notification1 = 'The invoice request raised on your behalf has been processed successfully';
    $subject = "Invoice Request - FarmKonnect";
    $content1 = "The invoice request raised for ".$fullname." has been processed successfully
    Thanks, Regards.
    ";
    $content2 = "The invoice request raised on your behalf has been processed successfully. Please contact FarmKonnect for more details
    Thanks, Regards.
    ";
    $resolve_request = $object->update_with_one_param($table,$param,$value,$new_value_param,$new_value);
    $resolve_request_decode = json_decode($resolve_request, true);
    if($resolve_request_decode['status'] == 0){
        echo "error";
    }else{
        echo "success";
        $object->insert_logs($_SESSION['adminid'], 'Resolved an Invoice Request');
        $object->email_function($email, $subject, $content1);
        $object->email_function($user_email, $subject, $content2);
        $object->insert_into_notifications_tbl($notification_type, $get_user_id['unique_id'], $notification_heading, $notification1);
        insert_into_admin_notifications_tbl($notification_type, $BE_id, $notification_heading, $notification);
    }
?>