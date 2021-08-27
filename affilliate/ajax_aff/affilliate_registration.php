<?php 
   session_start();
    require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    $object = new DbQueries();
    $other_names = $_POST['other_names'];
	$surname = $_POST['surname'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$uid = $_POST['uid'];

	$password = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];
	$table = 'affilliate_tbl';
	$param = 'email';
	$affiliate_status = $_POST['affilliate_type'];
	$unique_id = $object->unique_id_generator($email);
	$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"."activate.php?id=".$unique_id;
	$subject = "User Registration Activation Email";
	$content = "Click this link to activate your account. <a href='".$actual_link."'>".$actual_link. "</a";
	$link_message = $object->email_function($email, $subject, $content);
	$insert_users =  $object->insert_affiliate($table,$uid, $other_names, $surname, $password, $confirm_password, $phone , $email, $param,$unique_id,$affiliate_status);
	$insert_decode = json_decode($insert_users,true);
	echo $insert_decode['msg'];
	$_SESSION['affiliate_id'] = $uid;

	//if($insert_decode['status'] == '0'){
		//echo "error";
	//}else{
    // 	echo "success";	
	//}
  ?>