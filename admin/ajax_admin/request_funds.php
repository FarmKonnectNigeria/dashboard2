<?php
 include('../includes/instantiated_files.php');
	$amount = $_POST['amount'];	
	$admin_id = $uid;
    $get_super_admin = $object->get_rows_from_one_table('admin_tbl');
    foreach ($get_super_admin as $value) {
        $role_right = $value['role_right'];
        $get_role = $object->get_one_row_from_one_table('admin_roles', 'unique_id', $role_right);
        if($get_role['role_name'] == 'Super Administrator'){
            $get_admin_email = $object->get_one_row_from_one_table('admin_tbl', 'unique_id', $value['unique_id']);
            $super_admin_email = $get_admin_email['email'];
        }
    }
	$subject = "Funds Request - FarmKonnect";
	$content = "Accountant placed a request for cash. Please kindly approve or decline
	Thanks, Regards";
	$insert_fund_request = $object->funds_request($amount, $admin_id);
  $insert_fund_request_decode = json_decode($insert_fund_request, true);
	if($insert_fund_request_decode['status'] == 0){
		echo $insert_fund_request_decode['msg'];
	}else{
		echo "success";
		$description = "Requested for Cash";
		$object->insert_logs($uid, $description);
        $object->insert_expense_logs($admin_id, $description, $amount);
		$object->email_function($super_admin_email, $subject, $content);
	}

?>