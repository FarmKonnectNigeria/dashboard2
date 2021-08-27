<?php session_start();
    require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    $unique_id = $_POST['unique_id'];
    $object = new DbQueries();
    $table = 'business_executive_tbl';
    $param = 'unique_id';
    $value = $unique_id;
    $new_value_param = 'status';
    $new_value = 5;
    $place_on_probation = $object->update_with_one_param($table,$param,$value,$new_value_param,$new_value);
    $place_on_probation_decode = json_decode($place_on_probation, true);
    if($place_on_probation_decode['status'] == 0){
    	echo "error";
    }else{
    	echo "success";
        $object->insert_logs($_SESSION['adminid'], 'Placed a Business Evecutive on probation');
    }
?>