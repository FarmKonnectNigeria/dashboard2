<?php session_start();
    require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    $unique_id = $_POST['unique_id'];
    $object = new DbQueries();
    $table = 'business_executive_tbl';
    $param = 'unique_id';
    $value = $unique_id;
    $new_value_param = 'status';
    $new_value = 0;
    $sack_be_request = $object->update_with_one_param($table,$param,$value,$new_value_param,$new_value);
    $sack_be_request_decode = json_decode($sack_be_request, true);
    if($sack_be_request_decode['status'] == 0){
    	echo "error";
    }else{
        $update_assigned_to = $object->update_with_one_param('leads','assigned_to',$unique_id, 'assigned_to', '');
        $update_assigned_to_decode = json_decode($update_assigned_to, true);

        $get_num_leads = $object->get_number_of_rows_one_param('leads','assigned_to', $unique_id);

        $update_num_leads = $object->update_with_one_param('business_executive_tbl', 'unique_id', $unique_id, 'no_of_assigned_lead', $get_num_leads);
        $update_num_leads_decode = json_decode($update_num_leads, true);

        if($update_assigned_to_decode['status'] == 1 && $update_num_leads_decode['status'] == 1){
            echo "success";
        }
        $object->insert_logs($_SESSION['adminid'], 'Approved a request to sack Business Evecutive');
    }
?>