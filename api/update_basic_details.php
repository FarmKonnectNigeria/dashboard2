<?php 
session_start();
require_once("../classes/db_class.php");
require_once('db_connect.php');
include("../includes/config.php");
header('Content-Type: application/json');
$object = new DbQueries;
$uid = $_POST['uid'];
if( $_POST['surname'] != "" && $_POST['other_names'] != "" && $_POST['phone'] != "" && $_POST['home_address'] != "" && $_POST['dob'] != "" && $_POST['gender'] != ""
){
    $param = 'unique_id';
	$data = ['other_names', 'surname' , 'phone', 'alternate_phone', 'dob', 'home_address', 'gender'];

	$update_data =  $object->update_data('users_tbl',$data,$param,$uid);
	$update_decode = json_decode($update_data,true);

	echo json_encode(["status"=>$update_decode['status'], "msg"=> $update_decode['msg']]);
	// if($update_decode['status'] === '0'){
	// 	echo 500;
	// }else{ 
 //     	echo 200;	
	// }

 } else{
 	 echo json_encode(["status"=>"0", "msg"=> "empty_field(s)"]);
 }
?>