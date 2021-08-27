<?php
 include('../includes/instantiated_files.php');
	$unique_id = $_POST['unique_id'];
	$approve_transfer_client_request = $object->approve_client_transfer_request($unique_id);
  $approve_transfer_client_request_decode = json_decode($approve_transfer_client_request, true);
	if($approve_transfer_client_request_decode['status'] == 0){
		echo $approve_transfer_client_request_decode['msg'];
	}else{
		echo "success";
		$description = "Approved Transfer Client Request";
		$object->insert_logs($uid, $description);
	}

?>