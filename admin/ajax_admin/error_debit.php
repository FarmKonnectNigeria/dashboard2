<?php session_start();
    require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
   $unique_id = $_POST['unique_id'];
    $user_id = $_POST['user_id'];
    $amount = $_POST['amount'];
    $object = new DbQueries();
    $subject = "Error Debit - FarmKonnect";
    $content = "The error debit of ".$amount.". has been reversed, we are sorry for all inconviniences caused.
    Thanks, Regards";
    $reverse_error_debit = $object->error_debit($unique_id, $user_id, $amount);
    $reverse_error_debit_decode = json_decode($reverse_error_debit, true);
    $get_user_email = $object->get_one_row_from_one_table('users_tbl', 'unique_id', $user_id);
    $user_email = $get_user_email['email'];
    if($reverse_error_debit_decode){
    	echo $reverse_error_debit_decode['msg'];
    }else{
    	echo "success";
        $object->insert_logs($_SESSION['adminid'], 'Reversed an error debit');
        $object->email_function($user_email, $subject, $content);
    }
?>