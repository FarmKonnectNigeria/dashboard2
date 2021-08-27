<?php 
session_start();
require_once("../classes/db_class.php");
require_once('db_connect.php');
include("../includes/config.php");
//include("api_auth.php");
header('Content-Type: application/json');
$object = new DbQueries;
if(isset($_POST['uid']) && isset($_POST['description'])){
  $user_id = $_POST['uid'];
  $filename =  $_FILES['file']['name'];
  $size =  $_FILES['file']['size'];
  $type =  $_FILES['file']['type'];
  $tmpName  = $_FILES['file']['tmp_name'];
  $description = $_POST['description'];
  $amount = $_POST['amount'];
  $bank_name = $_POST['bank_name'];
  $account_name = $_POST['account_name'];
  $account_number = $_POST['account_number'];
  $upload_payment_proof = $object->upload_payment_proof2($description, $amount, $user_id, $bank_name, $account_name, $account_number, $filename, $size, $tmpName, $type);
  $upload_payment_proof_decode = json_decode($upload_payment_proof, true);
  //$msg = $upload_payment_proof_decode['msg'];
  if($upload_payment_proof_decode['status'] == '1'){ 
    $object->insert_users_logs($user_id, 'Uploaded a payment proof');
    echo json_encode(["status"=>"1", "msg"=> "success"]);
  }
  else{
   echo json_encode(["status"=>"2", "msg"=> $upload_payment_proof_decode['msg']]);
  }
}
else{
  echo json_encode(["status"=>"0", "msg"=> "empty_fields"]);
}
?>