<?php
 include('../includes/instantiated_files.php');
 require_once('../../classes/algorithm_functions.php');
 $invst_id = $_POST['investment_id'];
$admin_id = $_SESSION['adminid'];
 $backdate_investment = complete_backdate_action($invst_id,$admin_id);
    $backdate_investment_decode = json_decode($backdate_investment, true);
    if($backdate_investment_decode['status'] == 0){
    	echo $backdate_investment_decode['msg'];
    }else{
    	//echo "success";
    	echo $backdate_investment_decode['msg'];
        //$object->insert_logs($_SESSION['adminid'], 'Approved Backdate Investment request');
    }
?>