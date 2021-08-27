<?php
 include('../includes/instantiated_files.php');
	$bank_name = $_POST['bank_name'];
	$bank_description = $_POST['description'];
	$account_number = $_POST['account_number'];
	$account_name = $_POST['account_name'];
	$account_type = $_POST['account_type'];
	$admin_id = $uid;
	$add_bank_account = $object->insert_bank_account($admin_id, $bank_name, $bank_description, $account_number, $account_name, $account_type);
  $add_bank_account_decode = json_decode($add_bank_account, true);
	if($add_bank_account_decode['status'] == 0){
		echo $add_bank_account_decode['msg'];
	}else{
		echo "success";
		$description = "Added new bank account details";
		$object->insert_logs($uid, $description);
	}

?>