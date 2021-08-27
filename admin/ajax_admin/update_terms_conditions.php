<?php
 include('../includes/instantiated_files.php');
   
	$conditions_for_what = $_POST['conditions_for_what'];
	$description = $_POST['description'];
	$admin_id = $uid;
	if($conditions_for_what == "" || $description == ""){
		echo "empty_fields";
	}else{
	$update_terms_conditions = $object->update_with_one_param('terms_n_conditions','conditions_for_what',$conditions_for_what,'description',$description);
  $update_terms_conditions_decode = json_decode($update_terms_conditions, true);
	if($update_terms_conditions_decode['status'] == '0'){
		echo $update_terms_conditions_decode['msg'];
	}else{
		echo "success";
		$description = "Updated term and condition for ".$conditions_for_what;
		$object->insert_logs($uid, $description);
	}
}

?>