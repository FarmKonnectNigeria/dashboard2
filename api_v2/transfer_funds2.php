<?php
include("../includes/session.php");
require_once("../classes/db_class.php");
require_once('db_connect.php');
include("../includes/config.php");
include("api_auth.php");
header('Content-Type: application/json');
$object = new DbQueries;
    $user_id = $_POST['sender_id'];
    $amount = isset($_POST['amount']) ? $_POST['amount'] : '';
    $beneficiary_email = isset($_POST['beneficiary_email']) ? $_POST['beneficiary_email'] : '';
    $get_beneficairy_id = $object->get_one_row_from_one_table('users_tbl','email',$beneficiary_email);
    $beneficiary_id = $get_beneficairy_id['unique_id'];
    $transfer_pin = isset($_POST['transfer_pin']) ? $_POST['transfer_pin'] : '';

     $get_wallet_balance = $object->get_wallet_balance($user_id);
    $get_wallet_balance_decode = json_decode($get_wallet_balance,true);

    $get_wallet_status = $object->get_one_row_from_one_table('wallet_tbl', 'user_id', $user_id);
    $wallet_status = $get_wallet_status['wallet_status'];

     $get_beneficiary_balance = $object->get_wallet_balance($beneficiary_id);
       $get_beneficiary_balance_decode = json_decode($get_beneficiary_balance,true);

    $get_verification_status = $object->get_one_row_from_one_table('users_tbl','unique_id',$user_id);
    $verification_status = $get_verification_status['verification_status'];

    $check_wallet_balance = $object->check_wallet_balance($amount,$user_id);
    $check_wallet_balance_decode = json_decode($check_wallet_balance,true);

    $check_if_beneficiary_wallet_exist = $object->check_row_exists_by_one_param('wallet_tbl','user_id',$beneficiary_id);
    $check_if_beneficiary_email_exist = $object->check_row_exists_by_one_param('users_tbl', 'unique_id',$beneficiary_id);

     $check_transfer_pin = $object->check_transfer_pin($transfer_pin, $user_id);


     if($user_id == '' || $amount == 0 || $beneficiary_email == ''){
            echo  json_encode(["status"=>"0", "msg"=>"empty_fields"]);
          }

           else if($wallet_status == 0){
          echo json_encode(["status"=>"9", "msg"=>"wallet_deactivated"]);
    }

    
     else if($check_if_beneficiary_email_exist === false){
        echo json_encode(["status"=>"2", "msg"=>"user_does_not_exist"]);
      }
      
       else if($check_wallet_balance_decode['msg'] == "balance_less" ){
          echo json_encode(["status"=>"3", "msg"=>"balance_less"]);
        }


      else if ($check_transfer_pin === false) {
        echo json_encode(["status"=>"4", "msg"=>"incorrect_transfer_pin"]);
      }

    else{


            if ($verification_status == 0) {
              
              $data = $beneficiary_id.$amount;
            $beneficiary_unique_id = $object->unique_id_generator($data);
            $insert_into_transfer_log = "INSERT INTO `transfer_log` SET `unique_id` = '$beneficiary_unique_id', `sender_id`='$user_id',`transfer_status` = 0, `beneficiary_id`='$beneficiary_id', `amount_sent`='$amount', `date_created` = now()";
            $insert_into_transfer_log_query = mysqli_query($object->connection,$insert_into_transfer_log);


             ////debitwa
            $data = rand().$user_id;
            $unique_id = $object->unique_id_generator($data);
            $sql_insert_transaction_sender = "INSERT into debit_wallet_tbl set
                    `unique_id`='$unique_id',
                    `user_id`='$user_id',
                    `amount_withdrawn`='$amount',
                    `purpose`='15',
                    `package_id`='from_wallet_to_wallet',
                    `withdrawal_status`='0',
                    `processing_status`='0',
                    `date_created`=now()

                    ";
              $query_insert_transaction_sender = mysqli_query($object->connection,$sql_insert_transaction_sender);


               $sql_insert_transaction_receiver = "INSERT into debit_wallet_tbl set
                    `unique_id`='$unique_id',
                    `user_id`='$beneficiary_id',
                    `amount_withdrawn`='$amount',
                    `purpose`='18',
                    `package_id`='from_wallet_to_wallet',
                    `withdrawal_status`='0',
                    `processing_status`='0',
                    `date_created`=now()

                    ";
              $query_insert_transaction_receiver  = mysqli_query($object->connection,$sql_insert_transaction_receiver);


            if($insert_into_transfer_log_query === false  || $query_insert_transaction_sender === false || $query_insert_transaction_receiver === false){
            echo  json_encode(["status"=>"5", "msg"=>"error_creating_transfer_log"]);
            }else{
              echo json_encode(["status"=>"6", "msg"=>"success_creating_log"]);
            }

            }else if($verification_status == 1){
              
            $data = $beneficiary_id.$amount;
            $beneficiary_unique_id = $object->unique_id_generator($data);
            $insert_into_transfer_log = "INSERT INTO `transfer_log` SET `unique_id` = '$beneficiary_unique_id', `sender_id`='$user_id',`transfer_status` = 1, `processing_status`= 2, `beneficiary_id`='$beneficiary_id', `amount_sent`='$amount', `date_created` = now()";
            $insert_into_transfer_log_query = mysqli_query($object->connection,$insert_into_transfer_log);

              ////debitwa

            $data = rand().$beneficiary_id;
            $unique_id = $object->unique_id_generator($data);

            $sql_insert_transaction_sender = "INSERT into debit_wallet_tbl set
                    `unique_id`='$unique_id',
                    `user_id`='$user_id',
                    `amount_withdrawn`='$amount',
                    `purpose`='15',
                    `package_id`='from_wallet_to_wallet',
                    `withdrawal_status`='0',
                    `processing_status`='0',
                    `date_created`=now()

                    ";
              $query_insert_transaction_sender = mysqli_query($object->connection,$sql_insert_transaction_sender);


               $sql_insert_transaction_receiver = "INSERT into debit_wallet_tbl set
                    `unique_id`='$unique_id',
                    `user_id`='$beneficiary_id',
                    `amount_withdrawn`='$amount',
                    `purpose`='18',
                    `package_id`='from_wallet_to_wallet',
                    `withdrawal_status`='0',
                    `processing_status`='0',
                    `date_created`=now()

                    ";
              $query_insert_transaction_receiver  = mysqli_query($object->connection,$sql_insert_transaction_receiver);


            if($insert_into_transfer_log_query === false || $query_insert_transaction_sender === false || $query_insert_transaction_receiver === false){
            echo  json_encode(["status"=>"7", "msg"=>"error_creating_transfer_log"]);
            }

           $new_balance = $get_wallet_balance_decode['msg'] - $amount;
           $new_beneficiary_balance = $get_beneficiary_balance_decode['msg'] + $amount;



          ////update wallet balance
          $update_wallet_balance = $object->update_with_one_param('wallet_tbl','user_id',$user_id,'balance',$new_balance);
          $update_beneficiary_balance = $object->update_with_one_param('wallet_tbl','user_id',$beneficiary_id,'balance',$new_beneficiary_balance);

          ////we need to log the transfer transaction 
          ///id of the sender, id of the beneficiary,


          if($update_wallet_balance && $update_beneficiary_balance){
            echo json_encode(["status"=>"1", "msg"=>"success"]);
          }else{
            echo json_encode(["status"=>"8", "msg"=>"error"]);
          }

        }
        else{
              echo json_encode(["status"=>"0", "msg"=>"something_went_wrong"]);

        }
     // }
      }

?>