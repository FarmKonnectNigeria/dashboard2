<?php
include("../includes/session.php");
require_once("../classes/db_class.php");
require_once('db_connect.php');
include("../includes/config.php");
header('Content-Type: application/json');
$object = new DbQueries;
$data = [];
$user_id =$_GET['uid'];
$get_payment_proof = $object->get_rows_from_table_by_user_id('bank_transfer_tbl','user_id',$user_id);
if($get_payment_proof == null){
  echo json_encode(["status"=>0, "msg"=>"no_document_found"]);
}else{
  foreach ($get_payment_proof as $value) {
    if($value['payment_status'] == 0){
      $payment_status = "pending";
    }else if($value['payment_status'] == 1){
      $payment_status = "approved";
    }else if($value['payment_status'] == 2){
      $payment_status = "rejected";
    }else{
      $payment_status = "no status";
    }
    $payment_proof = [
      "unique_id"=>$value['unique_id'],
      "bank_name"=>$value['bank_name'],
      "account_number"=>$value['account_number'],
      "account_name"=>$value['account_name'],
      "description"=>$value['description'],
      "amount"=>$value['amount'],
      "payment_status"=>$payment_status,
      "payment_proof"=>"https://".$_SERVER[HTTP_HOST]."/".$value['payment_proof'],
      "date_created"=>$value['date_created']
    ];
    array_push($data, $payment_proof);
  }
  echo json_encode(["status"=>"1", "msg"=>$data]);
}
?>