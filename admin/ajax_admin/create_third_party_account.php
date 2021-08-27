<?php
 include('../includes/instantiated_files.php');
	$other_names = $_POST['other_names'];
	$surname = $_POST['surname'];
	$str = 'abcdef';
	$rand = rand(0, 1000);
	$password = 'fk_'.str_shuffle($str).$rand;
	$subject= 'User Account - FarmKonnect';
	//$confirm_password = $_POST['confirm_password'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	//$dob = $_POST['dob'];
	$unique_id = $object->unique_id_generator($surname.$other_names.$email);
	$create_third_party_account = $object->create_third_party_account($other_names, $surname, $password, $phone , $email, $unique_id);
  $create_third_party_account_decode = json_decode($create_third_party_account, true);
	if($create_third_party_account_decode['status'] == 0){
		echo $create_third_party_account_decode['msg'];
	}else{
		$content="Based on your request, a FarmKonnect account has been created on your behalf and your default password is ".$password." you are advised to change your password immediately you login.<br> Thanks, <br>Warm Regards";
		$send_email = $object->email_function($email, $subject, $content);
		if($send_email){
			echo "success";
			$description = "Setup account for a user";
			$object->insert_logs($uid, $description);
		}
	}

?>