<?php session_start();
    require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    $unique_id = $_POST['unique_id'];
    $BE_id = $_POST['BE_id'];
    $monthly_target = $_POST['monthly_target'];
    $object = new DbQueries();
    $approve_request = $object->update_with_one_param('target_request','unique_id',$unique_id,'target_status', 2);
    $approve_request_decode = json_decode($approve_request, true);
    if($approve_request_decode['status'] == 0){
    	echo "error";
    }else{
        $get_be_target = $object->get_one_row_from_one_table('be_target', 'BE_id', $BE_id);
        $new_be_balance = $monthly_target - $get_be_target['sales_made'];

        $update_target = $object->update_with_one_param('be_target','BE_id',$BE_id,'target_set',$monthly_target);
        $update_target_decode = json_decode($update_target, true);

        $update_target_commission_tbl = $object->update_with_one_param('target_bonus_commission','set_for',$BE_id,'monthly_target',$monthly_target);
        $update_target_commission_tbl_decode = json_decode($update_target_commission_tbl, true);

        $update_balance = $object->update_with_one_param('be_target','BE_id',$BE_id,'balance',$new_be_balance);
        $update_balance_decode = json_decode($update_balance, true);
        if($update_target_decode['status'] == 1 && $update_balance_decode['status'] == 1 && $update_target_commission_tbl_decode['status'] == 1){
    	   echo "success";
        }
        $object->insert_logs($_SESSION['adminid'], 'Approved BE Target Adjustment');
    }
?>