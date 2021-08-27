<?php include('../includes/instantiated_files2.php');
      if($_POST['profit'] == 0 || $_POST['amount_to_withdraw'] == 0 ){
      		echo 0; //Empty Field Found
      }else{
           $package_id = $_POST['get_withdrawable_profit'];
           $profit_balance = $_POST['profit'];
           $amount_to_withdraw = $_POST['amount_to_withdraw'];
           $balance = $_POST['profit'] - $_POST['amount_to_withdraw'];//profit
           $insert_withdrawal_request = $object->insert_withdrawal_request($package_id,$uid,$amount_to_withdraw,$profit_balance);
           $insert_withdrawal_request_decode = json_decode($insert_withdrawal_request,true);
           //if($insert_withdrawal_request_decode['status'] == 1 ){
           		echo $insert_withdrawal_request_decode['status'];
           //}else{
         //  	   echo 500;//dberror
         //}
          // echo $insert_withdrawal_request_decode['msg'];
      }
      
     
?>

