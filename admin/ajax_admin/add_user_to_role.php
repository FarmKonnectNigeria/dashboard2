<?php
session_start();
require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    $other_names = $_POST['other_names'];
    $surname = $_POST['surname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $role_id = $_POST['role_id'];
    $assigned_by = $_SESSION['adminid'];
   $subject = "Admin Registration - FarmKonnect";
    $content = "You have been added as an admin on FarmKonnect, your default password is ".$password. " 
    Thanks, Regards";
    //print_r($_POST);
    $object = new DbQueries();

    $add_user_to_role = $object->add_admin_to_role($other_names, $surname, $username, $password, $confirm_password, $phone , $email, $role_id, $address, $gender);
    $add_user_to_role_decode = json_decode($add_user_to_role, true);
    if($add_user_to_role_decode['status'] == 0){
    echo $add_user_to_role_decode['msg'];
    }else{
    	echo "success";
    	$description = "Added a new admin";
		$object->insert_logs($assigned_by, $description);
        $object->email_function($email, $subject, $content);
    }
 ?>