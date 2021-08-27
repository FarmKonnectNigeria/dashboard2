<?php
 include('../includes/instantiated_files.php');
   require_once('../../classes/algorithm_functions.php');
	$package_id = $_POST['package_id'];
	$description = $_POST['description'];
	$admin_id = $uid;
	$add_terms_conditions = insert_package_terms_conditions($admin_id, $description, $package_id);
  $add_terms_conditions_decode = json_decode($add_terms_conditions, true);
	if($add_terms_conditions_decode['status'] == 0){
		echo $add_terms_conditions_decode['msg'];
	}else{
		echo "success";
		$description = "Added new term and condition for package";
		$object->insert_logs($uid, $description);
	}

?>