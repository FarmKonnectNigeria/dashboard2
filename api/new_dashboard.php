<?php
include("../includes/session.php");
require_once("../classes/db_class.php");
require_once("../classes/algorithm_functions.php");
require_once('db_connect.php');
include("../includes/config.php");
header('Content-Type: application/json');
$object = new DbQueries;
$uid = $_GET['uid'];
$total_investment = $object->get_total_investment($uid);
 $total_investment_decode = json_decode($total_investment,true);

 $wallet_balance = $object->get_one_row_from_one_table('wallet_tbl','user_id',$uid);
 
 $my_latest_withdrawal = $object->my_latest_withdrawal($uid);
 $my_latest_withdrawal_decode = json_decode($my_latest_withdrawal,true);

 $my_latest_deposit = $object->my_latest_deposit($uid);
 $my_latest_deposit_decode = json_decode($my_latest_deposit,true);

 $my_total_deposit = $object->my_total_deposit($uid);
 $my_total_deposit_decode = json_decode($my_total_deposit,true);

 $my_total_withdrawal = $object->my_total_withdrawal($uid);
 $my_total_withdrawal_decode = json_decode($my_total_withdrawal,true);
 
 
 ///get total floating profit:
  $getpack = $object->get_rows_from_one_table_by_id('subscribed_packages','user_id',$uid);
  
  $total_fp = 0;
  
  foreach($getpack as $pack){
        $investmentid = $pack['unique_id'];
        ///get details for running investment: floating
        $dets_running_investment = get_details_for_a_running_investment($investmentid);
        $dets_running_investment_dec = json_decode($dets_running_investment,true);
        
        // "profit_per_day"=>$profit_per_day,
        // "days_so_far"=>$days_so_far,
        // "total_profit_so_far"=>$total_profit_so_far,
        // "floating_days"=>$floating_days,
        // "floating_profit"=>$floating_profit,
        // "accrued_days"=>$accrued_days,
        // "accrued_profit"=>$accrued_profit,
        // "date_investment_starts"=>$date_investment_starts,
        
        if($dets_running_investment_dec['status']  == 1){
        $floating_profit = $dets_running_investment_dec['floating_profit'];
        $format_floating_profit = number_format($dets_running_investment_dec['floating_profit']);
        $days_so_far = number_format($dets_running_investment_dec['days_so_far']);
        $total_fp = $total_fp + $floating_profit;
        }
        ////////sam end here
  } 
 
 

echo json_encode(["status"=>"1", 
	"total_investment"=>number_format($total_investment_decode['msg']),
	"wallet_balance"=>number_format($wallet_balance['balance']),
	"recent_withdrawal"=>number_format($my_latest_withdrawal_decode['msg']),
	"recent_deposit"=>number_format($my_latest_deposit_decode['msg']),
	"total_deposit"=>number_format($my_total_deposit_decode['msg']),
	"total_withdrawal"=>number_format($my_total_withdrawal_decode['msg']),
	"total_floating_profit"=>number_format($total_fp),
	"format_total_floating_profit"=>number_format($total_fp)
]);
?>