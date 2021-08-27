<?php
 include('../includes/instantiated_files.php');
	$bonus = $_POST['bonus'];
	$commission = $_POST['commission'];
	if(isset($_POST['BE_id'])){
		$BE_id = $_POST['BE_id'];
	}else{
		$BE_id = '';
	}
	//print_r($BE_id);
	$set_by = $uid;
	$insert_bonus_commission = $object->set_bonus_commission($bonus, $commission, $set_by, $BE_id);
  $insert_bonus_commission_decode = json_decode($insert_bonus_commission, true);
	if($insert_bonus_commission_decode['status'] == 0){
		echo $insert_bonus_commission_decode['msg'];
	}else{
		echo "success";
		$description = "Placed a request to set BE bonus/commission";
		$object->insert_logs($uid, $description);
	}

?>