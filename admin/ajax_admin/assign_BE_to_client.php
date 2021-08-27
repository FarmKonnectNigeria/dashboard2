<?php session_start();
    require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    $unique_id = $_POST['unique_id'];
    $BE_id = $_POST['BE_id'];
    $object = new DbQueries();
    $table = 'leads';
    $param = 'unique_id';
    $value = $unique_id;
    $new_value_param = 'assigned_to';
    $new_value = $BE_id;
    $get_BEs = $object->get_rows_from_one_table('business_executive_tbl');
    if($BE_id !== ''){
        $assign_BE = $object->update_with_one_param($table,$param,$value,$new_value_param,$new_value);
        $assign_BE_decode = json_decode($assign_BE, true);
        if($assign_BE_decode['status'] == 0){
        	echo "error";
        }else{
            foreach ($get_BEs as  $value) {
                $get_num_leads = $object->get_number_of_rows_one_param('leads','assigned_to', $value['unique_id']);
                $update_num_leads = $object->update_with_one_param('business_executive_tbl', 'unique_id', $value['unique_id'], 'no_of_assigned_lead', $get_num_leads);
                $update_num_leads_decode = json_decode($update_num_leads, true);
            }
            if($update_num_leads_decode['status'] == 1){
                echo "success";
            }
            $object->insert_logs($_SESSION['adminid'], 'Assigned BE to a client');
        }
    }
    else{
        echo "empty_fields";
    }
?>