<?php session_start();
    require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    require_once('../../classes/algorithm_functions.php');
    $unique_id = $_POST['user_id'];
    $object = new DbQueries();
    $table = 'admin_tbl';
    $param = 'unique_id';
    $value = $unique_id;
    $new_value_param = 'access_level';
    $new_value = 0;
    $disable_user_account = $object->update_with_one_param($table,$param,$value,$new_value_param,$new_value);
    $disable_user_account_decode = json_decode($disable_user_account, true);
    if($disable_user_account_decode['status'] == 0){
        echo "error";
    }else{
        echo "success";
        $object->insert_logs($_SESSION['adminid'], "Deactivated Admin's Account");
    }
?>