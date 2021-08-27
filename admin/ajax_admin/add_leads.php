<?php
session_start();
require_once('../../classes/db_class.php');
require_once('../../classes/algorithm_functions.php');
    require_once('../../includes/config.php');
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $location = $_POST['location_source'];
    $notification_type = 'alert';
    $notification_heading = 'New Leads';
    $notification = 'Hello, a new lead has been added, please check the lead pool';
    if(empty($_POST['other_location'])){
         $other_location = 'NULL'; 
      }else{
    $other_location = $_POST['other_location'];
}
    $classification = $_POST['classification'];
    $interest_level = $_POST['interest_level'];
    $social_media = $_POST['social_media'];
    $added_by = $_SESSION['adminid'];
    $object = new DbQueries();

    $get_no_assigned_lead = $object->get_one_row_from_one_table('business_executive_tbl','unique_id', $added_by);
    $no_assigned_lead = $get_no_assigned_lead['no_of_assigned_lead'];

    $get_role_right = $object->get_one_row_from_one_table('admin_tbl','unique_id', $added_by);      
    $get_role_name = $object->get_one_row_from_one_table('admin_roles','unique_id', $get_role_right['role_right']);
    $role_name = $get_role_name['role_name'];

    if($role_name == 'Business Executive'){
        $assigned_to = $added_by;
        $add_lead = $object->add_leads($fullname, $phone, $added_by, $assigned_to, $email, $location, $other_location, $classification, $interest_level, $social_media);
        $no_assigned_lead = $object->get_number_of_rows_one_param('leads','assigned_to', $added_by);
        //@$no_assigned_lead = $no_assigned_lead + 1;
        $update_bussiness_executive_tbl = $object->update_with_one_param('business_executive_tbl', 'unique_id', $added_by, 'no_of_assigned_lead', $no_assigned_lead);

    }else{
        $get_bEs = $object->get_rows_from_one_table('business_executive_tbl');
        $numbers_of_leads = array_column($get_bEs, 'no_of_assigned_lead');
        $least_no_of_lead = min($numbers_of_leads);
        $BE_with_least_no_lead = $object->get_one_row_from_one_table('business_executive_tbl','no_of_assigned_lead', $least_no_of_lead);
        $assigned_to = $BE_with_least_no_lead['unique_id'];
        $add_lead = $object->add_leads($fullname, $phone, $added_by, $assigned_to, $email, $location, $other_location, $classification, $interest_level, $social_media);
        $no_assigned_lead = $object->get_number_of_rows_one_param('leads','assigned_to', $assigned_to);
        //@$no_assigned_lead = $no_assigned_lead + 1;
        $update_bussiness_executive_tbl = $object->update_with_one_param('business_executive_tbl', 'unique_id', $assigned_to, 'no_of_assigned_lead', $no_assigned_lead);

    }
    $add_lead_decode = json_decode($add_lead, true);
    if($add_lead_decode['msg'] == 'empty_fields'){
    echo 300;
    }else if($add_lead_decode['msg'] == 'record_exists'){
        echo 400;
    }
    else{
        echo 200;
        $description = "Added a new lead";
        $object->insert_logs($added_by, $description);
        $get_MMs = $object->get_one_row_from_one_table('admin_roles', 'role_name', 'Marketing Manager');
        $get_MM_id = $object->get_rows_from_one_table_by_id('admin_tbl', 'role_right', $get_MMs['unique_id']);
        foreach ($get_MM_id as $value) {
            insert_into_admin_notifications_tbl($notification_type, $value['unique_id'], $notification_heading, $notification);
        }
        if($role_name == 'Business Executive'){

        }

    }
 ?> 