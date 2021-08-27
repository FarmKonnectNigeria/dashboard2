<?php
include("../includes/session.php");
require_once("../classes/db_class.php");
require_once('db_connect.php');
include("../includes/config.php");
header('Content-Type: application/json');
$object = new DbQueries;
$uid = $_GET['uid'];
$my_transaction_history = $object->my_transaction_history($uid);
$history = [];
foreach($my_transaction_history as $value){
                        if($value['purpose'] == 7){
                          $tansaction_category = 'debit';
                          $transaction_type = 'withdrawal';
                          $status = "processed"; }
                         elseif($value['purpose'] == 5) {
                          $tansaction_category = 'debit';
                          $transaction_type = 'withdrawal';
                           $status = "pending"; 
                          }elseif($value['purpose'] == 6) {
                          $tansaction_category = 'debit';

                          $transaction_type = 'withdrawal';
                           $status = "declined"; 
                          }elseif($value['purpose'] == 8) {
                          $tansaction_category = 'debit';
                          
                          $transaction_type = 'withdrawal';
                           $status = "cancelled"; 
                          }elseif($value['purpose'] == 9) {
                          $tansaction_category = 'debit';
                          
                          $transaction_type = 'withdrawal';
                           $status = "approved"; 
                          }
                          elseif($value['purpose'] == 10) {
                          $tansaction_category = 'credit';
                          
                          $transaction_type = 'wallet crediting';
                          $status = "pending"; 
                          }
                          elseif($value['purpose'] == 11) {
                          $tansaction_category = 'credit';
                          
                          $transaction_type = 'wallet crediting';
                          $status = "confirmed"; 
                          }


                          else{
                          $tansaction_category = 'transaction cate';
                          
                           $transaction_type = 'tansaction_type';
                           $status = "pendinggg"; 
                             
                          }
$data = ["amount"=>$value['amount_withdrawn'],
  "tansaction_category"=>$tansaction_category,
  "transaction_type"=>$transaction_type,
  "status"=>$status,
  "date"=>$value['date_created']];
array_push($history, $data);


}
echo json_encode(["status"=>"1", 
  "msg"=>$history

]);
?>