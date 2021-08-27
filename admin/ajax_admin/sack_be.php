<?php session_start();
    require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    $unique_id = $_POST['unique_id'];
    $object = new DbQueries();
    $table = 'business_executive_tbl';
    $param = 'unique_id';
    $value = $unique_id;
    $new_value_param = 'status';
    $new_value = 3;
    $sack_be_request = $object->update_with_one_param($table,$param,$value,$new_value_param,$new_value);
    $sack_be_request_decode = json_decode($sack_be_request, true);
    if($sack_be_request_decode['status'] == 0){
    	echo "error";
    }else{
    	echo "success";
        $object->insert_logs($_SESSION['adminid'], 'Sent a request to sack Business Evecutive');
    }
?>