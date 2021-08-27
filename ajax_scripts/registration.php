<?php //session_start();
    require_once('../classes/db_class.php');
    require_once('../includes/config.php');
    $object = new DbQueries();
    $other_names = $_POST['other_names'];
	$surname = $_POST['surname'];
	$gender = $_POST['gender'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];
	$table = 'users_tbl';
	$param = 'email';
	$unique_id = $object->unique_id_generator($email);
	$insert_users =  $object->insert_users_without_referral($table, $other_names, $gender, $surname, $password, $confirm_password, $phone , $email, $param, $unique_id);
	$get_uid = $object->get_one_row_from_one_table('users_tbl','email',$email);
	$uid = $get_uid['unique_id'];
// 	$actual_link = "http://".$_SERVER[HTTP_HOST]."/activate_user.php?id=".$uid;
// 	$subject = "User Registration Activation Email";
// 	$content = "Click this link to activate your account ";
// 	$content .= "<a href='https://$_SERVER[HTTP_HOST]/activate_user.php?id=$uid'>". $actual_link. "</a>";
	$insert_decode = json_decode($insert_users,true);
	if($insert_decode['msg'] == 'success'){
	$link_message = $object->user_activation_link_mail($uid, $email);
	}
	echo $insert_decode['msg'];
  ?>