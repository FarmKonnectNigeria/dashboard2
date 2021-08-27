<?php session_start();
    require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    $unique_id = $_POST['unique_id'];
    $object = new DBQueries();
    $table = 'debit_wallet_tbl';
    $param = 'unique_id';
    $value = $unique_id;
    $user_id = $_POST['user_id'];
    $new_value_param = 'purpose';
    $get_wallet_balance = $object->get_wallet_balance($user_id);
    $get_wallet_balance_decode = json_decode($get_wallet_balance, true);
    $wallet_balance = $get_wallet_balance_decode['msg'];
    $amount_withdrawn = $_POST['amount_withdrawn'];
    $new_balance = $wallet_balance - $amount_withdrawn;
    $get_purpose = $object->get_one_row_from_one_table('debit_wallet_tbl','unique_id',$unique_id);
    	if($get_purpose['purpose'] == 2){
    		$new_value = 4;
    	}else if($get_purpose['purpose'] == 5){
    		$new_value = 7;
    	}
    $object->update_with_one_param('wallet_tbl','user_id',$user_id, 'balance',$new_balance);
    
    $approve_request = $object->update_with_one_param($table,$param,$value,$new_value_param,$new_value);
    $approve_request_decode = json_decode($approve_request, true);
    if($approve_request_decode['status'] == 0){
    	echo "error";
    }else{
    	echo "success";
        $object->insert_logs($_SESSION['adminid'], 'Approved withdrawal request');
    }
?>