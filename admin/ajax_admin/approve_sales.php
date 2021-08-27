<?php
 include('../includes/instantiated_files.php');
	$BE_id = $_POST['BE_id'];
	$amount = $_POST['amount'];
	$unique_id = $_POST['unique_id'];
	$approve_sales = $object->update_with_one_param('be_sales', 'unique_id', $unique_id, 'sales_status', 1);
  $approve_sales_decode = json_decode($approve_sales, true);
	if($approve_sales_decode['status'] == 0){
		echo $approve_sales_decode['msg'];
	}else{
		echo "success";
		$description = "Approveed Sale";
		$object->insert_logs($uid, $description);
	}

?>