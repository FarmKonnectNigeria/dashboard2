<?php
session_start();
require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
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
    $add_lead = $object->add_leads($fullname, $phone, $assigned_by, $email, $location, $other_location, $classification, $interest_level);
    $add_lead_decode = json_decode($add_lead, true);
    if($add_lead_decode['msg'] == 'empty_fields'){
    echo 300;
    }else if($add_lead_decode['msg'] == 'record_exists'){
        echo 400;
    }
    else{
    	echo 200;
    	$description = "Added a new lead";
		$object->insert_logs($assigned_by, $description);
    }
 ?> 