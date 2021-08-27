<?php
 include('../includes/instantiated_files.php');
	$user_id = $_POST['user_id'];
	$amount = $_POST['amount'];
	$remarks = $_POST['remarks'];
	$admin_id = $uid;
	$subject = "Debit Account - FarmKonnect";
	$content = "Your account has been debited with ".$amount.". Please contact FarmKonnect for more details.
	Thanks, Regards";
	$debit_account = $object->debit_account($user_id, $amount, $remarks, $admin_id);
  $debit_account_decode = json_decode($debit_account, true);
  $get_user_email = $object->get_one_row_from_one_table('users_tbl', 'unique_id', $user_id);
  $user_email = $get_user_email['email'];
  $notification_type = 'alert';
  $notification_heading ='Debit Wallet';
  $notification = 'Your wallet has been debited with '.$amount;
	if($debit_account_decode['status'] == 0){
		echo $debit_account_decode['msg'];
	}else{
		echo "success";
		$description = "Debited a User's Account";
		$object->insert_logs($uid, $description);
		$object->email_function($user_email, $subject, $content);
		$object->insert_into_notifications_tbl($notification_type, $user_id, $notification_heading, $notification);
	}

?>