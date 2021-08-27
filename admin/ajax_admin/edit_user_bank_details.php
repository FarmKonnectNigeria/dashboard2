<?php
 include('../includes/instantiated_files.php');
	$user_id = $_POST['user_id'];
	$admin_id = $uid;
	$bank_details_array = $_POST;
	// $bank_name = $bank_details_array['bank_name'];
 //    $account_number = $bank_details_array['account_number'];
 //    $account_name = $bank_details_array['account_name'];
 //    $account_type = $bank_details_array['account_type'];
 //    $bvn = $bank_details_array['bvn'];
	$edit_user_bank_details = $object->insert_edit_user_bank_details_request($admin_id, $user_id, $bank_details_array);
  $edit_user_bank_details_decode = json_decode($edit_user_bank_details, true);
	if($edit_user_bank_details_decode['status'] == 0){
		echo $edit_user_bank_details_decode['msg'];
	}else{
		echo "success";
		$description = "Sent a request to edit investor's detail";
		$object->insert_logs($uid, $description);
	}

?>