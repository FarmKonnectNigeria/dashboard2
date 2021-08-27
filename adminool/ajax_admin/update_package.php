<?php
 	require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
	$unique_id = $_POST['unique_id'];
	$package_name = $_POST['package_name'.$unique_id];
	$package_description = $_POST['package_description'.$unique_id];
	$slot = $_POST['slot'.$unique_id];
	$amount_per_slot = $_POST['amount_per_slot'.$unique_id];
	$interest_rate = $_POST['interest_rate'.$unique_id];
	$no_of_month = $_POST['no_of_month'.$unique_id];
	$max_no_of_months = $_POST['max_no_of_months'.$unique_id];
	@$visibility_name = $_POST['visibility'.$unique_id];
	$visibility = null;
	if(isset($visibility_name)){
		$visibility = 0;
	}else{
		$visibility = 1;
	}
	
	// $table = 'package_category';
	// $param = 'unique_id';
	$object = new DBQueries();
	$update_package = $object->update_package($package_name, $package_description, $unique_id, $slot, $amount_per_slot, $interest_rate, $no_of_month, $max_no_of_months, $visibility);
	$update_package_decode = json_decode($update_package, true);
	if($update_package_decode['status'] === '0'){
		echo "error";
	}else{
		echo "success";
	}

?>