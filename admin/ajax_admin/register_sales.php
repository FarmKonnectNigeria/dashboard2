<?php
 include('../includes/instantiated_files.php');
	$transaction = $_POST['transaction'];
	$product = $_POST['product'];
	$amount = $_POST['amount'];
	$sales_date = $_POST['sales_date'];
	$admin_id = $uid;
	$register_sales = $object->be_register_sales($transaction, $amount, $product, $sales_date, $admin_id);
  	$register_sales_decode = json_decode($register_sales, true);
	if($register_sales_decode['status'] == 0){
		echo $register_sales_decode['msg'];
	}else{
		echo "success";
		$description = "Registered Sales";
		$object->insert_logs($uid, $description);
	}

?>