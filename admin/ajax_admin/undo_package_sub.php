<?php
 include('../includes/instantiated_files.php');
 require_once('../../classes/db_class.php');
 $investment_id = $_POST['investment_id'];
 $total_amount = $_POST['total_amount'];
 $no_of_slots_bought = $_POST['no_of_slots_bought'];
 $user_id = $_POST['user_id'];
 $package_id = $_POST['package_id'];
$admin_id = $_SESSION['adminid'];
 $undo_package_sub = $object->undo_package_sub($no_of_slots_bought, $user_id, $investment_id, $total_amount, $package_id);
    $undo_package_sub_decode = json_decode($undo_package_sub, true);
    if($undo_package_sub_decode['status'] == 0){
    	echo $undo_package_sub_decode['msg'];
    }else{
    	echo "success";
        $object->insert_logs($_SESSION['adminid'], 'Deleted package subscription');
    }
?>