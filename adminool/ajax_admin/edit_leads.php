<?php
session_start();
require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $unique_id = $_POST['unique_id'];
    $location = $_POST['location_source'];
    if(empty($_POST['other_location'])){
         $other_location = 'NULL'; 
      }else{
    $other_location = $_POST['other_location'];
}
    $classification = $_POST['classification'];
    $interest_level = $_POST['interest_level'];
    $assigned_by = $_SESSION['adminid'];
    $object = new DbQueries();
    $update_leads = $object->update_leads($fullname, $phone, $unique_id, $email, $location, $other_location, $classification, $interest_level);
    $update_leads_decode = json_decode($update_leads, true);
    if($update_leads_decode['msg'] == 'empty_fields'){
    echo 300;
    }else if($update_leads_decode['msg'] == 'record_exists'){
        echo 400;
    }
    else{
        echo 200;
        $description = "Updated a lead's details";
        $object->insert_logs($assigned_by, $description);
    }
 ?> 