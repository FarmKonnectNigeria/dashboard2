<?php
include("../includes/session.php");
require_once("../classes/db_class.php");
require_once('db_connect.php');
include("../includes/config.php");
include("api_auth.php");
header('Content-Type: application/json');
$object = new DbQueries;
$uid = $_GET['uid'];
$my_withdrawal_requests = $object->my_withdrawal_requests($uid);
$api_contents = [];
foreach ($my_withdrawal_requests as $key => $value) {

	if($value['purpose'] == 7){
     $withdrawal_status = "processed"; }
    elseif($value['purpose'] == 5) {
       $withdrawal_status = "pending"; 
     }elseif($value['purpose'] == 6) {
       $withdrawal_status = "declined"; 
     }elseif($value['purpose'] == 8) {
      $withdrawal_status = "cancelled"; 
     }elseif($value['purpose'] == 9) {
       $withdrawal_status = "approved"; 
     }else{
       $withdrawal_status = "pendinggg"; 
                             
     }
	   $data = [ "amount_withdrawn"=>$value['amount_withdrawn'],
                "withdrawal_status"=>$withdrawal_status,
                "date"=>$value['date_created']
              ];
    array_push($api_contents, $data);

}
echo json_encode(["status" => 1, "msg"=>$api_contents]);


?>