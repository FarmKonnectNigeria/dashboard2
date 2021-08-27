<?php
include("../includes/session.php");
require_once("../classes/db_class.php");
require_once('db_connect.php');
include("../includes/config.php");
header('Content-Type: Content-Type: application/json');
$object = new DbQueries;
      if(isset($_SESSION['uid'])){
         header("location:home");
          exit();
      }
$table = 'debit_wallet_tbl';
$param1 = 'user_id';
$param2 = 'purpose';
//$get_rows = $object->get_rows_from_one_table_by_two_params($table,$param1,$uid,$param2,1);
$get_rows = $object->get_rows_from_one_table_by_id('subscribed_user_tbl','user_id',$_SESSION['uid']);
 foreach ($get_rows as $value) {
 $profit = $object->get_profits1($_SESSION['uid']);
$profit_decode = json_decode($profit,true);
$getpackage = $object->get_one_row_from_one_table('package_tbl','unique_id',$value['package_id']);
 }

echo json_encode(["status"=>"1", "msg"=>$get_rows]);
?>