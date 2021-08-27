<?php
    include('../includes/instantiated_files.php');
    include('../../classes/algorithm_functions.php');
    $investment_id = $_POST['investment_id'];
    $object = new DbQueries();
    $table = 'added_profits_log_for_running_investments_for_processing';
    $param = 'investment_id';
    $value = $investment_id;
    $new_value_param = 'processing_status';
    $new_value = 1;
    $approve_request = $object->update_with_one_param($table,$param,$value,$new_value_param,$new_value);
    $approve_request_decode = json_decode($approve_request, true);
    if($approve_request_decode['status'] == 0){
        echo "error";
    }else{
        echo "success";
    }
?>