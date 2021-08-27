<?php
 include('../includes/instantiated_files.php');
 require_once('../../classes/algorithm_functions.php');
 $invstid = $_POST['investment_id'];
 $accrued_profit = $_POST['accrued_profit'];
$admin_id = $_SESSION['adminid'];
 $undo_backdate = undo_backdate_investment_migration($invstid,$accrued_profit);
    $undo_backdate_decode = json_decode($undo_backdate, true);
    if($undo_backdate_decode['status'] == 0){
    	echo $undo_backdate_decode['msg'];
    }else{
    	echo "success";
        //$object->insert_logs($_SESSION['adminid'], 'Deleted package subscription');
    }
?>