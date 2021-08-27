<?php session_start();
    require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    
    $monthly_target = $_POST['monthly_target'];
    $BE_id = $_POST['BE_id'];
    $admin_id = $_SESSION['adminid'];

    $object = new DbQueries();
    $request_edit_individual_target = $object->edit_individual_target_request($monthly_target, $BE_id, $admin_id);
    $request_edit_individual_target_decode = json_decode($request_edit_individual_target, true);
    if($request_edit_individual_target_decode['status'] == 0){
        echo "error";
    }else{
        echo "success";
        $object->insert_logs($_SESSION['adminid'], 'Sent a request to edit individual BE target');
    }
?>