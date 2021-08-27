<?php
 include('../includes/instantiated_files.php');
	$bank_name = $_POST['bank_name'];
	$amount = $_POST['amount'];
	$depositor_id = $_POST['depositor_id'];
	$insert_payment = $object->insert_online_payment($bank_name, $amount, $depositor_id);
  $insert_payment_decode = json_decode($insert_payment, true);
	if($insert_payment_decode['status'] == 0){
		echo $insert_payment_decode['msg'];
	}else{
		echo "success";
		$description = "Logged Payment";
		$object->insert_logs($uid, $description);
	}

?>