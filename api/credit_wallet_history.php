<?php
include("../includes/session.php");
require_once("../classes/db_class.php");
require_once('db_connect.php');
include("../includes/config.php");
header('Content-Type: Content-Type: application/json');
$object = new DbQueries;
      $table = 'credit_wallet_tbl';
$param1 = 'user_id';
$get_rows = $object->get_rows_from_table_by_user_id($table,$param1,$_GET['uid']);
echo json_encode(["status"=>"1", "msg"=>$get_rows]);
?>