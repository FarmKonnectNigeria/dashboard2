<?php
include("../includes/session.php");
require_once("../classes/db_class.php");
require_once('db_connect.php');
include("../includes/config.php");
header('Content-Type: application/json');
$object = new DbQueries;
$data = [];
$created_by =$_GET['uid'];
$get_documents = $object->get_rows_from_table_by_user_id('document_tbl','user_id',$created_by);
if($get_documents == null){
  echo json_encode(["status"=>0, "msg"=>"no_document_found"]);
}else{
  foreach ($get_documents as $value) {
    $document = [
      "unique_id"=>$value['unique_id'],
      "document_name"=>$value['document_name'],
      "document_url"=>"https://".$_SERVER[HTTP_HOST]."/".$value['image_url'],
      "date_created"=>$value['date_created']
    ];
    array_push($data, $document);
  }
  echo json_encode(["status"=>"1", "msg"=>$data]);
}
?>