<?php
include("../includes/session.php");
require_once("../classes/db_class.php");
require_once('db_connect.php');
include("../includes/config.php");
//include("api_auth.php");
header('Content-Type: application/json');
$object = new DbQueries;
$package_id = isset($_GET['package_id']) ? $_GET['package_id'] : '';
if($package_id == ''){
	echo json_encode(["status"=>"0", "msg"=>"empty_fields"]);
}else{
	$get_terms_condition = $object->get_one_row_from_one_table('package_term_condition','package_id',$package_id);
	if($get_terms_condition == null){
		echo json_encode(["status"=>"1", "msg"=>"No terms and conditions for this package"]);
	}else{
		echo json_encode(["status"=>"1", "msg"=>$get_terms_condition['description']]);
	}
}
?>