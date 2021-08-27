<?php
 include('../includes/instantiated_files.php');
   
	$conditions_for_what = $_POST['conditions_for_what'];
	$description = $_POST['description'];
	$admin_id = $uid;
	$add_terms_conditions = $object->insert_terms_n_conditions($admin_id, $description, $conditions_for_what);
  $add_terms_conditions_decode = json_decode($add_terms_conditions, true);
	if($add_terms_conditions_decode['status'] == '0'){
		echo $add_terms_conditions_decode['msg'];
	}else{
		echo "success";
		$description = "Added new term and condition";
		$object->insert_logs($uid, $description);
	}

?>