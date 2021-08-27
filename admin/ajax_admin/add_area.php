<?php
 include('../includes/instantiated_files.php');
  include('../../classes/algorithm_functions.php');
	$area_name = $_POST['area_name'];
	$area_description = $_POST['area_description'];
	$admin_id = $uid;
	$add_cctv_area = add_cctv_area($admin_id, $area_name, $area_description);
  $add_cctv_area_decode = json_decode($add_cctv_area, true);
	if($add_cctv_area_decode['status'] == 0){
		echo $add_cctv_area_decode['msg'];
	}else{
		echo "success";
		$description = "Added a new CCTV Area";
		$object->insert_logs($uid, $description);
	}

?>