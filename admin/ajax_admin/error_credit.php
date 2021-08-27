<?php
 include('../includes/instantiated_files.php');
 require_once('../../classes/algorithm_functions.php');
	$user_id = $_POST['user_id'];
	$unique_id = $_POST['unique_id'];
	$amount	= $_POST['amount'];
	$admin_id = $uid;
	$get_username = $object->get_one_row_from_one_table('users_tbl', 'unique_id', $user_id);
	$fullname_user = $get_username['surname'].' '.$get_username['other_names'];
	$notification_type = 'alert';
    $notification_heading = 'Error Credit';
    $notification = 'You marked a credit as error';
    $notification1 = "Hello, a credit of " .$amount. " to " .$fullname_user. " was marked as error by the Accountant";
	$error_credit = $object->error_credit($unique_id, $user_id, $admin_id, $amount);
  	$error_credit_decode = json_decode($error_credit, true);
	if($error_credit_decode['status'] == 0){
		echo $error_credit_decode['msg'];
	}else{
		echo "success";
		$description = "Marked Credit Wallet as Error";
		$object->insert_logs($uid, $description);
		$object->insert_expense_logs($uid, $description, $amount);
		$get_SA = $object->get_one_row_from_one_table('admin_roles', 'role_name', 'Super Administrator');
        $get_SA_id = $object->get_rows_from_one_table_by_id('admin_tbl', 'role_right', $get_SA['unique_id']);
        foreach ($get_SA_id as $value) {
            insert_into_admin_notifications_tbl($notification_type, $value['unique_id'], $notification_heading, $notification1);
        }
        insert_into_admin_notifications_tbl($notification_type, $admin_id, $notification_heading, $notification);
	}

?>