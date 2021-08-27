<?php 
session_start();
require_once("../classes/db_class.php");
require_once('db_connect.php');
include("../includes/config.php");
include("api_auth.php");
header('Content-Type: application/json');
$object = new DbQueries;
$unique_id = $_GET['id'];
    $table = 'users_tbl';
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $object = new DBQueries;
    $reset_password = $object->reset_password($table, $unique_id, $password, $confirm_password);
    $reset_decode = json_decode($reset_password, true);
    echo json_encode(["status"=>$reset_decode['status'], "message"=>$reset_decode['msg']]);
    if($reset_decode['msg'] == 'success'){
        $object->insert_users_logs($unique_id, 'Reset Password');
    }
   //echo $reset_decode['msg'];
?>