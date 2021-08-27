<?php
include("../includes/session.php");
require_once("../classes/db_class.php");
require_once('db_connect.php');
include("../includes/config.php");
header('Content-Type: application/json');
$object = new DbQueries;
  $uid = $_GET['uid'];
  $get_transfer_access = $object->get_one_row_from_one_table('wallet_tbl','user_id', $uid);
  if($get_transfer_access['transfer_access'] == 0){
  	echo json_encode(["status"=>"0", "msg"=>"not_requested"]);
  }else if($get_transfer_access['transfer_access'] == 1){
  		echo json_encode(["status"=>"1", "msg"=>"pending"]);
  }else if($get_transfer_access['transfer_access'] == 2){
  		echo json_encode(["status"=>"2", "msg"=>"approved"]);
  }else if($get_transfer_access['transfer_access'] == 3){
  	echo json_encode(["status"=>"3", "msg"=>"rejected"]);
  }else{
  	echo json_encode(["status"=>"5", "msg"=>"status_unknown"]);
  }
?>