<?php
 include('../includes/instantiated_files.php');
 require_once('../../classes/algorithm_functions.php');
	$client_id = $_POST['select_client'];
	$package_id = $_POST['package'];
	$get_package_category = $object->get_one_row_from_one_table('package_definition', 'unique_id', $package_id);
	$package_category_id = $get_package_category['package_category'];
	$quantity = $_POST['quantity'];

	$get_amount = $object->get_one_row_from_one_table('package_definition', 'unique_id', $package_id);
	$each_amount = $get_amount['package_unit_price'];
	$amount = $quantity * $each_amount;
	$admin_id = $uid;

	$subject = "Payment Request Confirmation - FarmKonnect";
	$content = "A Payment Request has been sent to you, please kindly confirm it";

	 $notification_type = 'alert';
    $notification_heading = 'Payment Request Confirmation';
    $notification = 'Hello, a Payment Request has been sent to you, please kindly confirm it';

	$insert_reminder = $object->payment_confirmation_request($admin_id, $client_id, $package_category_id, $package_id, $quantity, $amount);
  $insert_reminder_decode = json_decode($insert_reminder, true);
	if($insert_reminder_decode['status'] == 0){
		echo $insert_reminder_decode['msg'];
	}else{
		echo "success";
		$description = "Set a reminder";
		$object->insert_logs($uid, $description);
		$object->email_function('accountant@farmkonnectng.com', $subject, $content);
		$get_accountant = $object->get_one_row_from_one_table('admin_roles', 'role_name', 'Accountant');
        $get_accountant_id = $object->get_rows_from_one_table_by_id('admin_tbl', 'role_right', $get_accountant['unique_id']);
        foreach ($get_accountant_id as $value) {
            insert_into_admin_notifications_tbl($notification_type, $value['unique_id'], $notification_heading, $notification);
        }
	}

?>