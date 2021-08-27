<?php 
session_start();
require_once("../classes/db_class.php");
require_once('db_connect.php');
include("../includes/config.php");
header('Content-Type: application/json');
$object = new DbQueries;
$data = [];
$uid = $_GET['uid'];
$current_user_details = $object->get_current_user_info('users_tbl',$uid);
$user=["surname"=>$current_user_details['surname'],
"other_names"=> $current_user_details['other_names'],
"gender"=>$current_user_details['gender'],
"phone"=>$current_user_details['phone'],
"email"=>$current_user_details['email'],
"date_of_birth"=>$current_user_details['dob'],
"home_address"=>$current_user_details['home_address'],
"bank_name"=>$current_user_details['bank_name'],
"account_name"=>$current_user_details['account_name'],
"account_number"=>$current_user_details['account_number'],
"account_type"=>$current_user_details['account_type'],
"bvn"=>$current_user_details['bvn'],
"social_media_handle" =>$current_user_details['social_media_handle'],
"nok_surname" => $current_user_details['nok_surname'],
"nok_name" => $current_user_details['nok_name'],
"nok_phone" => $current_user_details['nok_phone'],
"nok_email" => $current_user_details['nok_email'],
"contact_address" => $current_user_details['contact_address'],
"relationship" => $current_user_details['relationship']
];
array_push($data, $user);
echo json_encode(["status"=>"1", "msg"=>$user]);

?>