<?php
include("../includes/session.php");
require_once("../classes/db_class.php");
//require_once('db_connect.php');
include("../includes/config.php");
include("api_auth.php");
header('Content-Type: application/json');
$object = new DbQueries;
 $get_account_details = $object->get_rows_from_one_table('bank_accounts');
echo json_encode(["status"=>"1", "msg"=>$get_account_details]);
?>