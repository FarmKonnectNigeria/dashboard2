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
$get_rows = $object->get_my_pending_withrawals($_SESSION['uid']);

$get_my_packages = $object->get_rows_from_one_table_by_id('subscribed_user_tbl','user_id',$_SESSION['uid']);

$profit = $object->get_profits1($_SESSION['uid']);
$profit_decode = json_decode($profit,true);

$total_withdrawn = $object->my_total_pending_withdrawn($_SESSION['uid']);
$total_withdrawn_decode = json_decode($total_withdrawn,true);
echo json_encode(["status"=>"1", "msg"=>$get_rows]);
?>