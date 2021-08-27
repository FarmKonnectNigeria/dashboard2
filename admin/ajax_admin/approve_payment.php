<?php session_start();
    require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    $unique_id = $_POST['unique_id'];
    $admin_id = $_POST['admin_id'];
    $client_email = $_POST['email'];
    $object = new DbQueries();
    $table = 'client_payment_log';
    $param = 'unique_id';
    $value = $unique_id;
    $new_value_param = 'payment_status';
    $new_value = 2;
    $subject = "Payment Request Confirmation - FarmKonnect";
    $content = "A Payment Request has been confirmed by the Cash Officer";
    $confirm_payment = $object->update_with_one_param($table,$param,$value,$new_value_param,$new_value);
    $confirm_payment_decode = json_decode($confirm_payment, true);
    $get_be = $object->get_one_row_from_one_table('admin_tbl', 'unique_id', 'admin_id');
    $be_email = $get_be['email'];
    if($confirm_payment_decode['status'] == 0){
    	echo "error";
    }else{
    	echo "success";
        $object->insert_logs($_SESSION['adminid'], 'Confirmed Payment');
        $object->email_function('accountant@farmkonnectng.com', $subject, $content);
        $object->email_function($client_email, $subject, $content);
        $object->email_function($be_email, $subject, $content);
    }
?>