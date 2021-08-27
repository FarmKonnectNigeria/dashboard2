<?php
include("../includes/session.php");
require_once("../classes/db_class.php");
require_once('db_connect.php');
include("../includes/config.php");
include("api_auth.php");
header('Content-Type: application/json');
$object = new DbQueries;
$uid = $_POST['uid'];
$amount_to_withdraw = $_POST['amount_to_withdraw'];
  if($uid == '' || $amount_to_withdraw == 0 ){
         echo json_encode(["status"=>"0", "msg"=>"empty_field(s)"]); //Empty Field Found
      }else{
        $get_wallet_balance = $object->get_one_row_from_one_table('wallet_tbl','user_id',$uid);
           $wallet_balance = $get_wallet_balance['balance'];
           // $amount_to_withdraw = $_POST['amount_to_withdraw'];

           if($wallet_balance < $amount_to_withdraw){
              echo json_encode(["status"=>"0", "msg"=>"insufficient_balance"]);
           }else{

                $new_balance = $wallet_balance - $amount_to_withdraw;

                $insert_withdrawal_request = $object->insert_wallet_withdrawal_request($uid,$amount_to_withdraw,$wallet_balance);
                $insert_withdrawal_request_decode = json_decode($insert_withdrawal_request,true);

                $notification_type = 'alert';
                $notification_heading = 'Withdrawal Request';
                $notification = 'You placed a Withdrawal Request';

                //echo $insert_withdrawal_request_decode['status'];
                if($insert_withdrawal_request_decode['status'] == 1){
                echo json_encode(["status"=>"1", "msg"=>"success"]);
                $object->insert_into_notifications_tbl($notification_type, $uid, $notification_heading, $notification);
                 $object->insert_users_logs($uid, 'Requested for withdrawal from Wallet');
                }
                else if($insert_withdrawal_request_decode['msg'] == "wallet_deactivated"){
                 echo json_encode(["status"=>"2", "msg"=>"wallet_deactivated"]);
                }
                else{
                echo json_encode(["status"=>"0", "msg"=>"error"]);//dberror
                }
                //echo $insert_withdrawal_request_decode['msg'];
                   
           }
      }
      
?>