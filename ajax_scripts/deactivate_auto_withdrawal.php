<?php
    require_once('../includes/instantiated_files3.php');
    $user_id = $_POST['user_id'];
    $object = new DbQueries();
    $table = 'users_tbl';
    $param = 'unique_id';
    $value = $user_id;
    $new_value_param = 'auto_withdrawal_status';
    $new_value = 0;
    if($user_id == ''){
        echo "empty_fields";
    }else{
        $approve_request = $object->update_with_one_param($table,$param,$value,$new_value_param,$new_value);
        $approve_request_decode = json_decode($approve_request, true);
        if($approve_request_decode['status'] == 0){
        	echo "error";
        }else{
        	echo "success";
        }
    }
?>