<?php
 include('../includes/instantiated_files.php');
 require_once('../../classes/algorithm_functions.php');
 $investmentid = $_POST['investment_id'];
$admin_id = $_SESSION['adminid'];
 $reject_backdate_investment = reject_backdate_request($investmentid);
 //var_dump($reject_backdate_investment);
    $reject_backdate_investment_decode = json_decode($backdate_investment, true);
    if($reject_backdate_investment_decode['status'] == "0"){
    	echo $reject_backdate_investment_decode['msg'];
    }else{
    	echo "success";
        $object->insert_logs($_SESSION['adminid'], 'Rejected Backdate Investment request');
    }
?>