<?php
 include('../includes/instantiated_files.php');
	@$client_id = $_POST['select_client'];
	$message = $_POST['message'];
	$frequency = $_POST['frequency'];
	$today = date('Y-m-d');
	$date_to_commence = $_POST['date_to_commence'];
	$date_to_end = $_POST['date_to_end'];
	$admin_id = $uid;
	$get_email = $object->get_one_row_from_one_table('leads','unique_id', $client_id);
	$email = $get_email['email'];
	$insert_payment_reminder = $object->set_payment_reminder($admin_id, $client_id, $message, $frequency, $date_to_commence, $date_to_end);
  $insert_payment_reminder_decode = json_decode($insert_payment_reminder, true);
	if($insert_payment_reminder_decode['status'] == 0){
		echo $insert_payment_reminder_decode['msg'];
	}else{
		echo "success";
		$description = "Set Payment Reminder for Client";
		$object->insert_logs($uid, $description);
		
	}

?>