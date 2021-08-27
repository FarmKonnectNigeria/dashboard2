<?php 
	require_once('../includes/instantiated_files3.php');
	require_once('../classes/algorithm_functions.php');
    $table = 'contact_us_tbl';
	$data = ['user_id', 'issues', 'comment'];
	$param = 'unique_id';
	$object = new DbQueries();
	$unique_id = $object->unique_id_generator(md5(uniqid()));
	$validate_value = $unique_id;
	$notification_type = 'alert';
	$notification_heading = 'Complaint';
	$notification = 'You sent a complaint';
    $notification1 = 'Hello, a new complaint has been sent by a user';
	$insert_complaint =  $object->insert_into_db($table,$data,$param,$validate_value);
	$insert_complaint_decode = json_decode($insert_complaint, true);
	if($insert_complaint_decode['msg'] == 'record_exists'){
		echo 300;
		
	}else if($insert_complaint_decode['msg'] == 'empty_fields'){
		echo 400;

	}else if($insert_complaint_decode['msg'] == 'db_error'){
		echo 500;
	}
	else{
		echo "success";
		$object->insert_into_notifications_tbl($notification_type, $_POST['user_id'], $notification_heading, $notification);
		$object->insert_users_logs($_SESSION['uid'], 'Sent a Complaint');
        $get_FO = $object->get_one_row_from_one_table('admin_roles', 'role_name', 'Feedback Officer');
        $get_FO_id = $object->get_rows_from_one_table_by_id('admin_tbl', 'role_right', $get_FO['unique_id']);
        foreach ($get_FO_id as $value) {
            insert_into_admin_notifications_tbl($notification_type, $value['unique_id'], $notification_heading, $notification1);
        }
	}  
?>