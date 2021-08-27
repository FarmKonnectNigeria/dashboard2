<?php 
session_start();
require_once("../classes/db_class.php");
require_once("../classes/algorithm_functions.php");
require_once('db_connect.php');
include("../includes/config.php");
header('Content-Type: application/json');
$object = new DbQueries;
$data = [];
$uid = $_GET['uid'];
$getpack = $object->get_rows_from_one_table_by_id('subscribed_packages','user_id',$uid);
if($getpack !== null){
foreach($getpack as $pack){ 
  $package_details  =  $object->get_one_row_from_one_table('package_definition','unique_id',$pack['package_id']);
     $getcat = $object->get_one_row_from_one_table('package_category','unique_id',$package_details['package_category']);
     $investment_details = get_details_for_a_running_investment2($pack['unique_id']);
     $investment_details_decode = json_decode($investment_details, true);
     $get_liquidation_status  =  $object->get_one_row_from_one_table('liquidated_investments_tbl','investment_id',$pack['unique_id']);
     if($get_liquidation_status == null && $pack['liquidation_status'] == 0){
        $liquidation_status = "Not liquidated";
      }
      else if($get_liquidation_status['process_status'] == 0 || $get_liquidation_status['process_status'] == 1){
        $liquidation_status = "Liquidation pending";
      }
      else if($get_liquidation_status['process_status'] == 2 && $pack['liquidation_status'] == 1){
        $liquidation_status = "Liquidation approved";
      }
      else if($get_liquidation_status['process_status'] == 3){
        $liquidation_status = "Liquidation rejected";
      }
     $added_profit = get_total_dropped_profits_per_running_investments($pack['unique_id']);
     $added_profit_decode = json_decode($added_profit, true);
     if($investment_details_decode['status'] == 0){
      $floating_profit = "0";
     }else{
      $floating_profit = $investment_details_decode['floating_profit'];
     }

     if($investment_details_decode['status'] == 0){
      $days_so_far =$investment_details_decode['msg'];
     }else{
      $days_so_far = $investment_details_decode['days_so_far'].' day(s)';
     }

      if($package_details['package_type']  == 1){
         $product_type = "Fixed";
      }
     else {
        $product_type = "Recurrent";
      }

      if( $pack['package_type'] == "1"  ){
          $total_amount_invested = number_format($pack['total_amount']);
        if( $pack['tenure_of_product'] != "inf"  ){
          $annual_end_date = date('Y-m-d', strtotime($pack['date_created']. ' + '.$pack['tenure_of_product'].' days'));
          $expected_amount = number_format(  ($pack['package_unit_price'] * $pack['no_of_slots_bought'])  + ($pack['package_unit_price'] * $pack['no_of_slots_bought'] * $pack['multiplying_factor'] * $pack['tenure_of_product']) );
        }else{
          $annual_end_date = "This investment runs infinitely";
          $expected_amount = "This is based on the number of days your investment is left to run";
        }
      }
      
      
      ///what i touched for recurrent
      else{
            $total_amount_invested = number_format(get_total_recurrent_investments($pack['unique_id']));
            if( $pack['tenure_of_product'] != "inf"  ){
            $annual_end_date = date('Y-m-d', strtotime($pack['date_created']. ' + '.$pack['tenure_of_product'].' days'));
            $expected_amount = number_format(  ($pack['package_unit_price'] * $pack['no_of_slots_bought'])  + ($pack['package_unit_price'] * $pack['no_of_slots_bought'] * $pack['multiplying_factor'] * $pack['tenure_of_product']) );
            }else{
            $annual_end_date = "This investment runs infinitely";
            $expected_amount = "This is based on the number of days your investment is left to run";
            }
          
      }
      ///what i touched ends
      
      
      
      if($added_profit_decode['msg'] == null){
        $accrued_profit = 0;
      }else{
        $accrued_profit = $added_profit_decode['msg'];
      }

  $package = 
  ["unique_id"=>$package_details['unique_id'],
  "investment_id"=>$pack['unique_id'],
  "package_category"=>$getcat['name'],
  "package_name"=>$package_details['package_name'],
  "package_type"=>$product_type,
  "image_url"=>"https://".$_SERVER[HTTP_HOST]."/admin/".$package_details['image_url'],
  "no_of_slot_bought"=>$pack['no_of_slots_bought'],
  "pacakage_unit_price"=>$pack['package_unit_price'],
  "total_amount_invested" =>$total_amount_invested,
  "date_of_subscription" => $object->format_date($pack['date_created']),
  "tenure_of_product"=>$pack['tenure_of_product'].' days',
  "annual_end_date"=>$object->format_date($annual_end_date),
  "expected_amount_after_investment"=>$expected_amount,
  "floating_profit"=>$floating_profit,
  "floating_profit_format"=>number_format($floating_profit),
  "accrued_profit"=>$accrued_profit,
  "format_accrued_profit"=>number_format($accrued_profit),
  "days_so_far"=>$days_so_far,
  "liquidation_status" => $liquidation_status
];

array_push($data, $package);
 }
}

echo json_encode(["status"=>"1", "msg"=>$data]);
 

?>