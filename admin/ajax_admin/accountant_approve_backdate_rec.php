<?php
 include('../includes/instantiated_files.php');
 require_once('../../classes/algorithm_functions.php');
 $invst_id = $_POST['investment_id'];
$admin_id = $_SESSION['adminid'];
$contribut_days = $_POST['contributory_days'];
 $backdate_investment = complete_backdate_action_rec($invst_id,$admin_id,$contribut_days);
    $backdate_investment_decode = json_decode($backdate_investment, true);
    if($backdate_investment_decode['status'] == 0){
    	echo $backdate_investment_decode['msg'];
    }else{
    	echo "success";
        $object->insert_logs($_SESSION['adminid'], 'Approved Backdate Investment request');
    }
?>