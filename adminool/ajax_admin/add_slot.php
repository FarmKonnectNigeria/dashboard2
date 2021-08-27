<?php
 include('../includes/instantiated_files.php');
   
	$package_id = $_POST['package_id'];
	$no_of_slots = $_POST['no_of_slots'];
	$created_by = $uid;
	$add_slot = $object->add_slot($package_id, $no_of_slots, $created_by);
  $add_slot_decode = json_decode($add_slot, true);
	if($add_slot_decode['status'] == '0'){
		echo "error";
	}else{
		echo "success";
		$description = "Added ".$no_of_slots." slots";
		$object->insert_logs($uid, $description);
	}

?>