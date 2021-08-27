<?php session_start();
    require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    $unique_id = $_POST['unique_id'];
    $object = new DbQueries();
    $table = 'wallet_tbl';
    $param = 'user_id';
    $value = $unique_id;
    $new_value_param = 'wallet_status';
    $new_value = 0;
    $deactivate_wallet = $object->update_with_one_param($table,$param,$value,$new_value_param,$new_value);
    $deactivate_wallet_decode = json_decode($deactivate_wallet, true);
    $get_user = $object->get_one_row_from_one_table('users_tbl','unique_id',$unique_id);
    $username = $get_user['surname'].' '.$get_user['other_names'];
    if($deactivate_wallet_decode['status'] == 0){
    	echo "error";
    }else{
    	echo "success";
        $object->insert_logs($_SESSION['adminid'], "Deactivated ".$username."'s wallet");
    }
?>