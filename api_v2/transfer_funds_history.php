<?php
include("../includes/session.php");
require_once("../classes/db_class.php");
require_once('db_connect.php');
include("../includes/config.php");
include("api_auth.php");
header('Content-Type: application/json');
$object = new DbQueries;
$table = 'transfer_log';
$get_rows = $object->get_rows_from_one_table($table);
$api_data = [];
foreach($get_rows as $value){
   if($value['sender_id'] == $_GET['uid'] || $value['beneficiary_id'] == $_GET['uid'])
   {
     	$get_sender = $object->get_one_row_from_one_table(
     				'users_tbl',
     				'unique_id',
     				$value['sender_id']
     	);
     	$get_beneficiary = $object->get_one_row_from_one_table(
     					'users_tbl',
     					'unique_id',
     					$value['beneficiary_id']
		);
     	$data = ["history" => $value, "sender" => $get_sender, "beneficiary" => $get_beneficiary];
		array_push($api_data, $data);
		// echo json_encode(["status"=>"1", "msg"=>$get_sender]);
	}
}

echo json_encode(["status"=>"1", "msg"=>$api_data]);
?>