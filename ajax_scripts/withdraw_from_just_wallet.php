<?php require_once('../includes/instantiated_files3.php');
      if($_POST['wallet_balance'] == 0 || $_POST['amount_to_withdraw'] == 0 ){
          echo 350; //Empty Field Found
      }else{
           $wallet_balance = $_POST['wallet_balance'];
           $amount_to_withdraw = $_POST['amount_to_withdraw'];

           if($wallet_balance < $amount_to_withdraw){
              echo 500;
           }else{
                
                $new_balance = $wallet_balance - $amount_to_withdraw;

                $insert_withdrawal_request = $object->insert_wallet_withdrawal_request($uid,$amount_to_withdraw,$wallet_balance);
                $insert_withdrawal_request_decode = json_decode($insert_withdrawal_request,true);

                //update wallet
                // $update_wallet_balance = $object->update_with_one_param('wallet_tbl','user_id',$uid,'balance',$new_balance);
                // $update_wallet_balance_decode = json_decode($update_wallet_balance,true);

                $notification_type = 'alert';
                $notification_heading = 'Withdrawal Request';
                $notification = 'You placed a Withdrawal Request';

                //echo $insert_withdrawal_request_decode['status'];
                if($insert_withdrawal_request_decode['status'] == 1){
                echo 200;
                 $object->insert_into_notifications_tbl($notification_type, $uid, $notification_heading, $notification);
                 $object->insert_users_logs($_SESSION['uid'], 'Requested for withdrawal from Wallet');
                }
                else if($insert_withdrawal_request_decode['msg'] == "wallet_deactivated"){
                  echo 300;
                }
                else{
                    echo 600;//dberror
                }
                //echo $insert_withdrawal_request_decode['msg'];
                   
           }
      }
      
     
?>

