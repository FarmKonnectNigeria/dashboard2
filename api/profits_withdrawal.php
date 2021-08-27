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
$profit = $object->get_profits1($_SESSION['uid']);
$profit_decode = json_decode($profit,true);
 $total_earnings = $profit_decode['actual_withdrawable_profit'];
$investor_id = isset($_POST['investor_id']) ? $_POST['investor_id'] : '';
        $data = $investor_id.$total_earnings;
        $unique_id = $object->unique_id_generator($data);

        ///get current wallet balance of user::::
        $get_wallet_balance = $object->get_wallet_balance($investor_id);
        $get_wallet_balance_decode = json_decode($get_wallet_balance,true);

        if($total_earnings == '' || $investor_id == ''){
            echo  json_encode(["status"=>"0", "msg"=>"empty_fields"]);
          }

        else if($get_wallet_balance_decode['status'] ==  '0'){
            echo  json_encode(["status"=>0, "msg"=>"wallet_balance_error"]);

        }else{

            $wallet_balance = $get_wallet_balance_decode['msg'];
            $new_balance = $wallet_balance + $total_earnings;
            ////update wallet balance

            ////update wallet balance
          $update_wallet_balance = $object->update_with_one_param('wallet_tbl','user_id',$investor_id,'balance',$new_balance);

          if($update_wallet_balance){
            //echo json_encode(["status"=>"1", "msg"=>"success"]);
             $sql = "INSERT INTO `debit_wallet_tbl` SET `unique_id` = '$unique_id',`amount_withdrawn` = '$total_earnings',`user_id` = '$investor_id',  `purpose` = 4, `package_id` = 'earnings_to_wallet',`withdrawal_status` = 1 ,`date_created` = now()";
            $query = mysqli_query($con, $sql);
            if($query){
            echo  json_encode(["status"=>1, "msg"=>"success"]);
            }else{
            echo  json_encode(["status"=>0, "msg"=>"db_error"]);
            }

          }
          else{
            echo json_encode(["status"=>"0", "msg"=>"update_wallet_balance_error"]);
          }

      }
?>