<?php session_start();
    require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    $unique_id = $_POST['unique_id'];
    $monthly_target = $_POST['monthly_target'];
    $object = new DBQueries();
    $table = 'probation_target';
    $param = 'unique_id';
    $value = $unique_id;
    $new_value_param = 'monthly_target';
    $new_value = $monthly_target;
    $update_probation_target = $object->update_with_one_param($table,$param,$value,$new_value_param,$new_value);
    $update_probation_target_decode = json_decode($update_probation_target, true);
    if($update_probation_target_decode['status'] == 0){
    	echo "error";
    }else{
        $update_probation_be_target = $object->update_probation_be_target($_SESSION['adminid'], $monthly_target);
        $update_probation_be_target_decode = json_decode($update_probation_be_target, true);
        if($update_probation_be_target_decode['status'] == "1"){
    	   echo "success";
            $object->insert_logs($_SESSION['adminid'], 'Updated the probation target for New BEs');
        }   
    }
?>