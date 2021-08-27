<?php session_start();
    require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    $unique_id = $_POST['unique_id'];
    $bonus = $_POST['bonus'];
     $admin_id = $_POST['set_by'];
     $BE_id = $_POST['BE_id'];
    $object = new DbQueries();
    $approve_bonus_request = $object->approve_bonus_request($bonus, $unique_id, $BE_id, $admin_id);
    $approve_bonus_request_decode = json_decode($approve_bonus_request, true);
    if($approve_bonus_request_decode){
    	echo $approve_bonus_request_decode['msg'];
    }else{
    	echo "success";
        $object->insert_logs($_SESSION['adminid'], 'Approved set Bonus request');
    }
?>