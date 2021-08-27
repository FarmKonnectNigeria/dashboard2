<?php
session_start();
require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    $unique_id = $_POST['unique_id'];
     $assigned_by = $_SESSION['adminid'];
    //print_r($_POST);
    $object = new DbQueries();
    $archive_lead = $object->update_with_one_param('leads','unique_id',$unique_id,'status',0);
    $archive_lead_decode = json_decode($archive_lead, true);
    if($archive_lead_decode['status'] == 0){
    echo 500;
    }else{
        echo 200;
        $description = "Archived a Lead";
        $object->insert_logs($assigned_by, $description);
    }
 ?>