<?php
 include('../includes/instantiated_files.php');
	$BE_id = $_POST['BE_id'];
	$time_frame = $_POST['time_frame'];

	$insert_suspend_be_request = $object->suspend_be_request($time_frame, $BE_id);
  $insert_suspend_be_request_decode = json_decode($insert_suspend_be_request, true);
	if($insert_suspend_be_request_decode['status'] == 0){
		echo $insert_suspend_be_request_decode['msg'];
	}else{
		echo "success";
		$description = "Sent a request to suspend Business Executive";
		$object->insert_logs($uid, $description);
	}

?>