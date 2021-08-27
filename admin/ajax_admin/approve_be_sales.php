<?php
 include('../includes/instantiated_files.php');
	$BE_id = $_POST['BE_id'];
	$amount = $_POST['amount'];
	$unique_id = $_POST['unique_id'];
	$subject = "Sales Claim - FarmKonnect";
    $content = "Your sales of ".$amount." has been successfully approved, please proceed to your portal for more details
    Thanks, Regards";
    $get_BE_email = $object->get_one_row_from_one_table('admin_tbl', 'unique_id', $BE_id);
    $BE_email = $get_BE_email['email'];
	$approve_sales = $object->approve_be_sales($BE_id, $amount, $unique_id);
  $approve_sales_decode = json_decode($approve_sales, true);
	if($approve_sales_decode['status'] == 0){
		echo $approve_sales_decode['msg'];
	}else{
		echo "success";
		$description = "Approved Sale";
		$object->insert_logs($uid, $description);
		$object->email_function($BE_email, $subject, $content);
	}

?>