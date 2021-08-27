<?php
 include('../includes/instantiated_files.php');
   
	$package_id = $_POST['package_id'];
	$description = $_POST['description'];
	$admin_id = $uid;
	if($package_id == "" || $description == ""){
		echo "empty_fields";
	}else{
	$update_terms_conditions = $object->update_with_one_param('package_term_condition','package_id',$package_id,'description',$description);
  $update_terms_conditions_decode = json_decode($update_terms_conditions, true);
	if($update_terms_conditions_decode['status'] == '0'){
		echo $update_terms_conditions_decode['msg'];
	}else{
		echo "success";
		$description = "Updated term and condition for ".$package_id;
		$object->insert_logs($uid, $description);
	}
}

?>