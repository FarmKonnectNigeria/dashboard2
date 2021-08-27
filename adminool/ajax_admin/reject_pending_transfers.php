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
    $beneficiary_name = $get_sender_email['surname'].' '.$get_sender_email['other_names'];
     $content = "Your transfer of ".$amount_sent. " to" .$beneficiary_name. "failed
    Thanks, Regards";
    
    $update_transfer_log = $object->update_with_one_param('transfer_log','unique_id',$unique_id,'transfer_status',2);
    $update_transfer_log_decode = json_decode($update_transfer_log, true);
    if($update_transfer_log_decode['status'] == 0){
    	echo 500;
    }else{
    echo 200;
      $object->insert_logs($admin_id, 'Rejected funds transfer');
    $object->email_function($sender_email, $subject, $content);
}
?>