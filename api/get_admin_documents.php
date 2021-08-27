<?php
include("../includes/session.php");
require_once("../classes/db_class.php");
require_once('db_connect.php');
include("../includes/config.php");
header('Content-Type: application/json');
$object = new DbQueries;
$data = [];
//$created_by =$_GET['uid'];
$get_admin_documents = $object->get_rows_from_one_table('admin_document_tbl');
if($get_admin_documents == null){
  echo json_encode(["status"=>0, "msg"=>"no_document_found"]);
}else{
  foreach ($get_admin_documents as $value) {
    $document = [
      "document_name"=>$value['document_name'],
      "document_url"=>"https://".$_SERVER[HTTP_HOST]."/admin/".$value['image_url'],
      "date_created"=>$value['date_created']
    ];
    array_push($data, $document);
  }
  echo json_encode(["status"=>"1", "msg"=>$data]);
}
?>