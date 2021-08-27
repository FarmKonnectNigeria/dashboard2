<?php include('./includes/instantiated_files.php');
  $package_id = $_POST['package_name'];
	$no_of_slots = $_POST['no_of_slots'];
	$created_by = $fullname_user;
  $get_slot = $object->get_rows_from_one_table_by_id('package_tbl','unique_id',$package_id);
   $db_slot = $get_slot['slot'];
  $new_slot = $no_of_slots + $db_slot;
	$add_slot = $object->add_slot($package_id, $no_of_slots, $created_by, $new_slot);

	$add_slot_decode = json_decode($add_slot, true);
	echo $add_slot_decode['msg'];
  // if($add_slot_decode == '0'){
	// 	echo "error";
	// }else{
	// 	echo "success";
	// }

?>