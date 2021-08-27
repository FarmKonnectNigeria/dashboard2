<?php session_start();
    require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    $unique_id = $_POST['unique_id'];
    $object = new DBQueries();
    $table = 'client_payment_log';
    $param = 'unique_id';
    $value = $unique_id;
    $new_value_param = 'payment_status';
    $new_value = 3;
    $reject_payment = $object->update_with_one_param($table,$param,$value,$new_value_param,$new_value);
    $reject_payment_decode = json_decode($reject_payment, true);
    if($reject_payment_decode['status'] == 0){
    	echo "error";
    }else{
    	echo "success";
        $object->insert_logs($_SESSION['adminid'], 'Rejected Payment');
    }
?>