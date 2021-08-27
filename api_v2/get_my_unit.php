<?php 
session_start();
require_once("../classes/db_class.php");
require_once('db_connect.php');
include("../includes/config.php");
include("api_auth.php");
header('Content-Type: application/json');
$object = new DbQueries;
$data = [];
$uid = $_GET['uid'];
$get_rows = $object->get_rows_from_one_table('unit_to_user_assignment');
$msg_state = 0;
foreach($get_rows as $value){ 
$get_user_id = json_decode($value['user_id']);
//print_r($get_user_id);
$get_unit = $object->get_one_row_from_one_table('cctv_unit', 'unique_id', $value['unit_id']);
$get_area = $object->get_one_row_from_one_table('cctv_area', 'unique_id', $get_unit['area_id']);
//foreach ($get_user_id as $user_id) {
  if(in_array($uid, $get_user_id)){
    $msg_state++;
 $detail =["unit_name"=>$get_unit['unit_name'],
 		"area_name"=>$get_area['area_name'],
 		"cctv_link"=>$get_unit['cctv_link']
];
array_push($data, $detail);
}
else{
    if($msg_state < 1){
    	$msg =["msg"=>"no_unit"];
    }
}

}
if(isset($msg)){
    echo json_encode(["status"=>"0", "msg"=>$msg]);
}
else{echo json_encode(["status"=>"1", "msg"=>$data]);}
   

?>