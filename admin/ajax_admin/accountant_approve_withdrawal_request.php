<?php session_start();
    require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    $unique_id = $_POST['unique_id'];
    $object = new DbQueries();
    $table = 'debit_wallet_tbl';
    $param = 'unique_id';
    $value = $unique_id;
    $new_value_param = 'withdrawal_status';
    $new_value = 4;
    $approve_request = $object->update_with_one_param($table,$param,$value,$new_value_param,$new_value);
    $approve_request_decode = json_decode($approve_request, true);
    if($approve_request_decode['status'] == 0){
    	echo "error";
    }else{
    	echo "success";
        $object->insert_logs($_SESSION['adminid'], 'Approved Withdrawal request');
    }
?>