<?php
 include('../includes/instantiated_files.php');
	$item = $_POST['item'];
	$date_of_reminder = $_POST['date_of_reminder'];
	$frequency = $_POST['frequency'];
	$email_reminder = $_POST['email_reminder'];
	$admin_id = $uid;
	$subject = "Reminder - FarmKonnect";
	$content = "You set a reminder for today on FarmKonnect about ".$item."
	Thanks, Regards";
	$insert_reminder = $object->set_reminder($admin_id, $item, $frequency, $date_of_reminder);
  $insert_reminder_decode = json_decode($insert_reminder, true);
	if($insert_reminder_decode['status'] == 0){
		echo $insert_reminder_decode['msg'];
	}else{
		echo "success";
		$description = "Set a reminder";
		$object->insert_logs($uid, $description);
		if($email_reminder == "yes"){
		$object->email_function($email, $subject, $content);
		}
	}

?>