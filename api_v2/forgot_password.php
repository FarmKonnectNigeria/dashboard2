<?php 
session_start();
require_once("../classes/db_class.php");
require_once('db_connect.php');
include("../includes/config.php");
include("api_auth.php");
header('Content-Type: application/json');
$object = new DbQueries;
 $email = $_POST['email'];
    $table = 'users_tbl';
    $param = 'email';
    $object = new DBQueries;
    $check_user_exists = $object->check_row_exists_by_one_param($table,$param,$email);
    if($check_user_exists === false){
    	echo json_encode(["status"=>"0", "message"=>"user_does_not_exist"]);
    }
    else{
    	$get_user = $object->get_one_row_from_one_table($table,$param,$email);
    	$unique_id = $get_user['unique_id'];
    	$reset_password = $object -> user_reset_password_link($unique_id, $email);
    	echo json_encode(["status"=>"1", "message"=>"success"]);
    }
?>