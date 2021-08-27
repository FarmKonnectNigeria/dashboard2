<?php
include("../includes/session.php");
require_once("../classes/db_class.php");
require_once('db_connect.php');
include("api_auth.php");
include("../includes/config.php");
header('Content-Type: Content-Type: application/json');
$object = new DbQueries;
      if(isset($_SESSION['uid'])){
         header("location:home");
          exit();
      }
 $total_investment = $object->get_total_investment($_POST['uid']);
 $total_investment_decode = json_decode($total_investment,true);

 $packages_count = $object->get_number_of_rows_one_param('subscribed_user_tbl','user_id',$_SESSION['uid']);

$profit = $object->get_profits1($_SESSION['uid']);
$profit_decode = json_decode($profit,true);

$wallet_balance = $object->get_one_row_from_one_table('wallet_tbl','user_id',$_SESSION['uid']);


$total_withdrawable_balance = $object->get_profits1($_SESSION['uid']);
$total_withdrawable_balance_decode = json_decode($total_withdrawable_balance,true);
echo json_encode(["status"=>"1", "msg"=>$packages_count]);
echo json_encode(["status"=>"1", "msg"=>$total_investment]);
echo json_encode(["status"=>"1", "msg"=>$profit]);
echo json_encode(["status"=>"1", "msg"=>$wallet_balance]);
echo json_encode(["status"=>"1", "msg"=>$total_withdrawable_balance]);
?>