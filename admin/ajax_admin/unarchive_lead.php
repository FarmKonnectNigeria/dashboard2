<?php
session_start();
require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    $unique_id = $_POST['unique_id'];
     $assigned_by = $_SESSION['adminid'];
    //print_r($_POST);
    $object = new DbQueries();
    $unarchive_lead = $object->update_with_one_param('leads','unique_id',$unique_id,'status',1);
    $unarchive_lead_decode = json_decode($unarchive_lead, true);
    if($unarchive_lead_decode['status'] == 0){
    echo 500;
    }else{
        echo 200;
        $description = "Unarchived a Lead";
        $object->insert_logs($assigned_by, $description);
    }
 ?>