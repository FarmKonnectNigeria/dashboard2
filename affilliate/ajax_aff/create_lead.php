<?php
 include('../includes/instantiated_files.php');
    $first_name = $_POST['first_name'];
	$surname = $_POST['surname'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$created_by = $uid;
	
	$create_lead = $object->create_lead($first_name, $surname, $phone,$email,$created_by);
    $create_lead_decode = json_decode($create_lead, true);
	//if($add_slot_decode == '0'){
    echo $create_lead_decode['msg'];
	// 	echo "error";
	// }else{
	// 	echo "success";
	// }

?>