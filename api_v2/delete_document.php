<?php
include("../includes/session.php");
require_once("../classes/db_class.php");
require_once('db_connect.php');
include("../includes/config.php");
include("api_auth.php");
header('Content-Type: application/json');
$object = new DbQueries;
$unique_id = $_POST['document_id'];
$user_id = $_POST['user_id'];
if($unique_id == '' || $user_id == ''){
  echo json_encode(["status"=>"0", "msg"=>"empty_fields"]);
}
else{
  $table = 'document_tbl';
  $delete_document = $object->delete_a_row($table,'unique_id',$unique_id);
  if($delete_document){
    echo json_encode(["status"=>"1", "msg"=>"success"]);
    $object->insert_users_logs($user_id, 'Deleted a document');
  }
  else{
    echo json_encode(["status"=>"0", "msg"=>"error"]);
  }
}
?>