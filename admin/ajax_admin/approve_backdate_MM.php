<?php
   include('../includes/instantiated_files.php');
    $unique_id = $_POST['unique_id'];
    $approve_backdate = $object->update_with_one_param('backdate_investment_maker_checker','unique_id',$unique_id,'status', 1);
    $approve_backdate_decode = json_decode($approve_backdate, true);
    if($approve_backdate_decode['status'] == 0){
    	echo "error";
    }else{
    	echo "success";
        $object->insert_logs($_SESSION['adminid'], 'Approved Backdate request');
    }
?>