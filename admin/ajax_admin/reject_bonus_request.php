<?php session_start();
    require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    $unique_id = $_POST['unique_id'];
    $object = new DbQueries();
    $table = 'bonus_commission_request';
    $param = 'unique_id';
    $value = $unique_id;
    $new_value_param = 'bonus_status';
    $new_value = 2;
    $reject_bonus_request = $object->update_with_one_param($table,$param,$value,$new_value_param,$new_value);
    $reject_bonus_request_decode = json_decode($reject_bonus_request, true);
    if($reject_bonus_request_decode['status'] == 0){
        echo "error";
    }else{
        echo "success";
        $object->insert_logs($_SESSION['adminid'], 'Rejected set Bonus request');
    }
?>