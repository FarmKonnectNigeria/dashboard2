<?php
 include('../includes/instantiated_files.php');
 require_once('../../classes/algorithm_functions.php');
 $unique_id = $_POST['unique_id'];
 $investment_id = $_POST['investment_id'];
 $receiver_id = $_POST['receiver_id'];
 $transfer_ownership = confirm_transfer_of_investment_ownership($investment_id,$receiver_id);
    $transfer_ownership_decode = json_decode($transfer_ownership, true);
    if($transfer_ownership_decode['status'] == 0){
    	echo "error";
    }else{
    	echo "success";
        $object->insert_logs($_SESSION['adminid'], 'Approved Transfer of Ownership request');
    }
?>