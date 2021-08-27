<?php
include("../includes/session.php");
require_once("../classes/db_class.php");
require_once('db_connect.php');
include("../includes/config.php");
include("api_auth.php");
header('Content-Type: application/json');
$object = new DbQueries;
  $uid = $_GET['uid'];
  $get_card_access = $object->get_one_row_from_one_table('users_tbl','unique_id',$uid);
  if($get_card_access['verification_status'] == 0){
  	echo json_encode(["status"=>"0", "msg"=>"not verified"]);
  }
  else if($get_card_access['verification_status'] == 1){
  	echo json_encode(["status"=>"1", "msg"=>"verified"]);
  }
 else{
  	echo json_encode(["status"=>"2", "msg"=>"status_unknown"]);
  }
?>