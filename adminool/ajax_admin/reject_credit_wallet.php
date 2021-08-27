<?php session_start();
    require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    $user_id = $_POST['unique_id'];
    $admin_id = $_SESSION['adminid'];
    $object = new DbQueries();
    $subject = "Credit Wallet approval - FarmKonnect";
    $content = "Your credit wallet tranasction failed, please contact FarmKonnect for more information
    Thanks, Regards";
    $get_email = $object->get_one_row_from_one_table('users_tbl','unique_id',$user_id);
    $email = $get_email['email'];
    $update_credit_wallet_tbl = $object->update_with_one_param('credit_wallet_tbl','user_id',$user_id,'payment_status',2);
    $update_credit_wallet_tbl_decode = json_decode($update_credit_wallet_tbl, true);
    if($update_credit_wallet_tbl_decode['status'] == 0){
    	echo 500;
    }else{
    echo 200;
      $object->insert_logs($admin_id, 'Rejected credit wallet');
    $object->email_function($email, $subject, $content);
}
?>