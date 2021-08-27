<?php
 include('../includes/instantiated_files.php');
  include('../../classes/algorithm_functions.php');
	$unit_name = $_POST['unit_name'];
	$unit_description = $_POST['unit_description'];
	$area_id = $_POST['area_id'];
	$cctv_link = $_POST['cctv_link'];
	$admin_id = $uid;
	$add_unit = add_cctv_unit($admin_id, $unit_name, $unit_description, $area_id, $cctv_link);
  $add_unit_decode = json_decode($add_unit, true);
	if($add_unit_decode['status'] == 0){
		echo $add_unit_decode['msg'];
	}else{
		echo "success";
		$description = "Added a new Unit under an Area";
		$object->insert_logs($uid, $description);
	}

?>