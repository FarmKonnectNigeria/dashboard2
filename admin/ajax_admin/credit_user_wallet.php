<?php
 include('../includes/instantiated_files.php');
	$user_id = $_POST['user_id'];
	$amount	= $_POST['amount'];
	$admin_id = $uid;
	$subject = "Credit Wallet - FarmKonnect";
    $content = "Your account has been credited with ".$amount;" by FarmKonnect
    Thanks, Regards";
	$get_user_email = $object->get_one_row_from_one_table('users_tbl','unique_id',$user_id);
    $email_user = $get_user_email['email'];
    $notification_type = 'alert';
    $notification_heading ='Credit Wallet ';
    $notification = 'Your wallet has been credited with '.$amount.'  by FarmKonnect';
	$credit_user_wallet = $object->credit_user_wallet($user_id, $amount, $admin_id);
  	$credit_user_wallet_decode = json_decode($credit_user_wallet, true);
	if($credit_user_wallet_decode['status'] == 0){
		echo $credit_user_wallet_decode['msg'];
	}else{
		echo "success";
		$description = "Credited User's Wallet";
		$object->insert_logs($uid, $description);
		$object->insert_expense_logs($admin_id, $description, $amount);
		$object->email_function($email_user, $subject, $content);
    	$object->insert_into_notifications_tbl($notification_type, $user_id, $notification_heading, $notification);
	}

?>