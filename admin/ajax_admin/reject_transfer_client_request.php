<?php
 include('../includes/instantiated_files.php');
	$unique_id = $_POST['unique_id'];
    $table = 'transfer_client_log';
    $param = 'unique_id';
    $value = $unique_id;
    $new_value_param = 'status';
    $new_value = 2;
    $reject_transfer_client_request = $object->update_with_one_param($table,$param,$value,$new_value_param,$new_value);
    $reject_transfer_client_request_decode= json_decode($reject_transfer_client_request, true);
	if($reject_transfer_client_request_decode['status'] == 0){
		echo $reject_transfer_client_request_decode['msg'];
	}else{
		echo "success";
		$description = "Rejected Transfer Client Request";
		$object->insert_logs($uid, $description);
	}

?>