<?php include('../includes/instantiated_files2.php');
    
           $total_earnings = $_POST['total_earnings'];
           $balance = $_POST['profit'] - $_POST['amount_to_withdraw'];//profit
           $insert_earnings_to_wallet = $object->insert_earnings_to_wallet($uid,$total_earnings);
           $insert_earnings_to_wallet_decode = json_decode($insert_earnings_to_wallet,true);
           //if($insert_withdrawal_request_decode['status'] == 1 ){
           		echo $insert_earnings_to_wallet_decode['status'];
           //}else{
         //  	   echo 500;//dberror
         //}
          // echo $insert_withdrawal_request_decode['msg'];
      

// echo $_POST[''];
      
     
?>

