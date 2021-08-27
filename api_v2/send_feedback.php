<?php 
	require_once('../classes/algorithm_functions.php');
	require_once("../classes/db_class.php");
	require_once('db_connect.php');
	include("../includes/config.php");
	include("api_auth.php");
	header('Content-Type: application/json');
	$object = new DbQueries();
	$table = 'feedback_tbl';
	$data = ['user_id', 'heading', 'comment'];
	$param = 'unique_id';
	$unique_id = $object->unique_id_generator(md5(uniqid()));
	$validate_value = $unique_id;
	$notification_type = 'alert';
	$notification_heading = 'Feedback';
	$notification = 'You sent a feedback';
	$notification1 = 'Hello, a new feedback has been sent by a user';
	$insert_feedback =  $object->insert_into_db($table,$data,$param,$validate_value);
	$insert_feedback_decode = json_decode($insert_feedback, true);
	if($insert_feedback_decode['status'] == "0"){
		echo json_encode(["status"=>"0", "msg"=>$insert_feedback_decode['msg']]);
		
	}
	else{
		echo json_encode(["status"=>"1", "msg"=>"success"]);
		$object->insert_into_notifications_tbl($notification_type, $_POST['user_id'], $notification_heading, $notification);
		$object->insert_users_logs($_POST['user_id'], 'Sent a Feedback');
		$get_FO = $object->get_one_row_from_one_table('admin_roles', 'role_name', 'Feedback Officer');
        $get_FO_id = $object->get_rows_from_one_table_by_id('admin_tbl', 'role_right', $get_FO['unique_id']);
        foreach ($get_FO_id as $value) {
            insert_into_admin_notifications_tbl($notification_type, $value['unique_id'], $notification_heading, $notification1);
        }
	}

   
?>