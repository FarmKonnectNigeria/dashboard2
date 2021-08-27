<?php
 include('../includes/instantiated_files.php');
 require_once('../../classes/algorithm_functions.php');
 if(isset($_POST['select_client'])){
 	$client_id = $_POST['select_client'];
 }else{
 	$client_id = '';
 }
 $notification_type = 'alert';
$notification_heading = 'Invoice Request';
$notification = 'Hello, a new invoice request has been placed by the Business Executive';
 $get_client = $object->get_one_row_from_one_table('leads', 'unique_id', $client_id);
 //echo $get_client['fullname'];
	$fullname = !empty($_POST['fullname']) ? $_POST['fullname'] : $get_client['fullname'];
	$email = !empty($_POST['email']) ? $_POST['email'] : $get_client['email'];
	$phone = !empty($_POST['phone']) ? $_POST['phone'] : $get_client['phone'];
	$address = $_POST['address'];
	$package_bought = $_POST['package_bought'];
	$quantity = $_POST['quantity'];
	$admin_id = $uid;
	$insert_invoice_request = $object->request_invoice($fullname, $address, $package_bought, $quantity, $email, $phone, $admin_id);
  $insert_invoice_request_decode = json_decode($insert_invoice_request, true);
	if($insert_invoice_request_decode['status'] == 0){
		echo $insert_invoice_request_decode['msg'];
	}else{
		echo "success";
		$description = "Sent an Invoice Request";
		$object->insert_logs($uid, $description);
		$get_accountant = $object->get_one_row_from_one_table('admin_roles', 'role_name', 'Accountant');
        $get_accountant_id = $object->get_rows_from_one_table_by_id('admin_tbl', 'role_right', $get_accountant['unique_id']);
        foreach ($get_accountant_id as $value) {
            insert_into_admin_notifications_tbl($notification_type, $value['unique_id'], $notification_heading, $notification);
        }
        $get_CO = $object->get_one_row_from_one_table('admin_roles', 'role_name', 'Cash Officer');
        $get_CO_id = $object->get_rows_from_one_table_by_id('admin_tbl', 'role_right', $get_CO['unique_id']);
        foreach ($get_CO_id as $value) {
            insert_into_admin_notifications_tbl($notification_type, $value['unique_id'], $notification_heading, $notification);
        }
	}

?>