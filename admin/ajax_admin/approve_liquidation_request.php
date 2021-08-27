<?php
   include('../includes/instantiated_files.php');
    $investment_id = $_POST['investment_id'];
    $approve_liquidation_request = $object->update_with_one_param('liquidated_investments_tbl','investment_id',$investment_id,'process_status', 1);
    $approve_liquidation_request_decode = json_decode($approve_liquidation_request, true);
    if($approve_liquidation_request_decode['status'] == 0){
    	echo "error";
    }else{
    	echo "success";
        $object->insert_logs($_SESSION['adminid'], 'Approved Liquidation request');
    }
?>