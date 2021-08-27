<?php 
session_start();
require_once("../classes/db_class.php");
require_once('db_connect.php');
include("../includes/config.php");
include("api_auth.php");
header('Content-Type: application/json');
$object = new DbQueries;
$data = [];
if(!isset($_GET['uid'])){
	echo json_encode(["status"=>0, "msg"=>"empty_fields"]);
}
$uid = $_GET['uid'];
$get_feedback = $object->get_rows_from_one_table_by_one_param('feedback_tbl','user_id', $uid);
$get_complaint = $object->get_rows_from_one_table_by_one_param('contact_us_tbl','user_id', $uid);
foreach($get_feedback as $value){
	$get_user = $object->get_one_row_from_one_table('users_tbl','unique_id',$value['user_id']);
	if($value['status'] == 0){
	  $status = "New";
	}else if($value['status'] == 1){
		$status = "Escalated";
	}else if($value['status'] == 2){
		$status = "Noted";
	}
    $feedback=["full_name"=>$get_user['surname'].' '.$get_user['other_names'],
	"heading/issues"=>$value['heading'],
	"comment"=>$value['comment'],
	"status"=>$status,
];

array_push($data, $feedback);
}

foreach($get_complaint as $value){
	$get_user = $object->get_one_row_from_one_table('users_tbl','unique_id',$value['user_id']);
	if($value['status'] == 0){
	  $status = "New";
	}else if($value['status'] == 1){
		$status = "Escalated";
	}else if($value['status'] == 2){
		$status = "Resolved";
	}
    $complaint=["full_name"=>$get_user['surname'].' '.$get_user['other_names'],
	"heading/issues"=>$value['issues'],
	"comment"=>$value['comment'],
	"status"=>$status,
];

array_push($data, $complaint);
}
echo json_encode(["status"=>"1", "msg"=>$data]);  
?>