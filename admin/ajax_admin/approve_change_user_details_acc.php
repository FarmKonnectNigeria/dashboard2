<?php
 include('../includes/instantiated_files.php');
 $unique_id = $_POST['unique_id'];
 $new_email = $_POST['new_email'];
 $new_phone = $_POST['new_phone'];
 $user_id = $_POST['user_id'];
 $approve_request = $object->update_with_one_param('edit_sensitive_details_log','unique_id',$unique_id,'status', 2);
    $approve_request_decode = json_decode($approve_request, true);
    if($approve_request_decode['status'] == 0){
    	echo "error";
    }else{
    	if(!empty($new_email) AND !empty($new_phone)){
    		$update_user_phone = $object->update_with_one_param('users_tbl','unique_id',$user_id,'email', $new_email);
    		$update_user_phone_decode = json_decode($update_user_phone, true);

    		$update_user_email =$object->update_with_one_param('users_tbl','unique_id',$user_id,'phone', $new_phone);
    		$update_user_email_decode = json_decode($update_user_email, true);
    		if($update_user_phone_decode['status'] == 1 AND $update_user_email_decode['status'] == 1){
    			echo "success";
    		}
    	}
    	else if(!empty($new_email)){
    		$update_email_only = $object->update_with_one_param('users_tbl','unique_id',$user_id,'email', $new_email);
    		$update_email_only_decode = json_decode($update_email_only, true);
    		if($update_email_only_decode['status'] == 1){
    			echo "success";
    		}
    	}
    	else if(!empty($new_phone)){
    		$update_phone_only = $object->update_with_one_param('users_tbl','unique_id',$user_id,'phone', $new_phone);
    		$update_phone_only_decode = json_decode($update_phone_only, true);
    		if($update_phone_only_decode['status'] == 1){
    			echo "success";
    		}
    	}else{
    		echo "Nothing to update";
    	}
    	// if($update_email_only_decode['status'] == 1 OR $update_phone_only_decode['status'] == 1 OR ($update_user_phone_decode['status'] == 1 AND $update_user_email_decode['status'] == 1)){
    	// 	echo "success";
    	// }
        $object->insert_logs($_SESSION['adminid'], "Approved change of user's detail");
    }
?>