<?php 
session_start();
require_once("../classes/db_class.php");
require_once('db_connect.php');
include("../includes/config.php");
//include("api_auth.php");
header('Content-Type: application/json');
$object = new DbQueries;
if(isset($_POST['uid']) && isset($_POST['document_name'])){
  $created_by = $_POST['uid'];
  $document_name = $_POST['document_name'];
  $filename =  $_FILES['file']['name'];
  $size =  $_FILES['file']['size'];
  $type =  $_FILES['file']['type'];
  $tmpName  = $_FILES['file']['tmp_name'];
  $table = 'document_tbl';
  $upload_document = $object->upload_document2($table, $document_name, $created_by, $filename, $size, $tmpName, $type);
  $upload_document_decode = json_decode($upload_document, true);
  //$msg = $upload_document_decode['msg'];
  if($upload_document_decode['status'] == '1'){ 
    $object->insert_users_logs($created_by, 'Uploaded a document');
    echo json_encode(["status"=>"1", "msg"=> "success"]);
  }
  else{
   echo json_encode(["status"=>"2", "msg"=> $upload_document_decode['msg']]);
  }
}
else{
  echo json_encode(["status"=>"0", "msg"=> "empty_fields"]);
}
?>