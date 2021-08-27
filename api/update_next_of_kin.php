<?php 
session_start();
require_once("../classes/db_class.php");
require_once('db_connect.php');
include("../includes/config.php");
header('Content-Type: application/json');
$object = new DbQueries;
$uid = $_POST['uid'];
if( $_POST['nok_surname'] != "" && $_POST['nok_name'] != "" && $_POST['nok_phone'] != "" && $_POST['nok_email'] != ""
&& $_POST['contact_address'] != "" && $_POST['relationship'] != ""){
   
    $param = 'unique_id';
	$data = ['nok_surname', 'nok_name', 'nok_phone', 'nok_email', 'contact_address', 'relationship'];
	$object = new DbQueries();
	$update_data =  $object->update_data('users_tbl',$data,$param,$uid);
	$update_decode = json_decode($update_data,true);
	echo json_encode(["status"=>$update_decode['status'], "msg"=> $update_decode['msg']]);
	// if($update_decode['status'] === '0'){
	// 	echo 500;
	// }else{ 
 //     	echo 200;	
	// }
      } 
      else{

      	 echo json_encode(["status"=>"0", "msg"=> "empty_field(s)"]);
      }
?>