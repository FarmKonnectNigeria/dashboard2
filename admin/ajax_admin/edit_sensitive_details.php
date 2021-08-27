<?php
 include('../includes/instantiated_files.php');
	$user_id = $_POST['user_id'];
	$new_email = isset($_POST['email']) ? $_POST['email'] : null;
	$new_phone = isset($_POST['phone'])? $_POST['phone'] : null;
	$admin_id = $uid;
	$edit_sensitive_details = $object->insert_edit_sensitive_details_request($admin_id, $user_id, $new_email, $new_phone);
  $edit_sensitive_details_decode = json_decode($edit_sensitive_details, true);
	if($edit_sensitive_details_decode['status'] == 0){
		echo $edit_sensitive_details_decode['msg'];
	}else{
		echo "success";
		$description = "Sent a request to edit investor's detail";
		$object->insert_logs($uid, $description);
	}

?>