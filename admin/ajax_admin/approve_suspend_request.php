<?php session_start();
    require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    $unique_id = $_POST['unique_id'];
    $object = new DbQueries();
    $table = 'business_executive_tbl';
    $param = 'unique_id';
    $value = $_POST['BE_id'];
    $new_value_param = 'status';
    $new_value = 2;
    $suspend_be_request = $object->update_with_one_param($table,$param,$value,$new_value_param,$new_value);
    $suspend_be_request_decode = json_decode($suspend_be_request, true);
    if($suspend_be_request_decode['status'] == 0){
    	echo "error";
    }else{
    	// echo "success";
        $update_suspension_tbl = $object->update_with_one_param('be_suspension_tbl','unique_id', $unique_id, 'status', 1);
        $update_suspension_tbl_decode = json_decode($update_suspension_tbl, true);

        $update_assigned_to = $object->update_with_one_param('leads','assigned_to',$value, 'assigned_to', '');
        $update_assigned_to_decode = json_decode($update_assigned_to, true);

        $get_num_leads = $object->get_number_of_rows_one_param('leads','assigned_to', $value);
        $update_num_leads = $object->update_with_one_param('business_executive_tbl', 'unique_id', $value, 'no_of_assigned_lead', $get_num_leads);
        $update_num_leads_decode = json_decode($update_num_leads, true);

        if($update_suspension_tbl_decode['status'] == 1 && $update_assigned_to_decode['status'] == 1 && $update_num_leads_decode['status'] == 1){
            echo "success";
        }
        $object->insert_logs($_SESSION['adminid'], 'Approved a request to suspend Business Evecutive');
    }
?>