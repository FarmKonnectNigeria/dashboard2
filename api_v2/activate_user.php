<?php
include("../includes/session.php");
require_once("../classes/db_class.php");
require_once('db_connect.php');
include("../includes/config.php");
include("api_auth.php");
header('Content-Type: application/json');
$object = new DbQueries;
  $unique_id = $_GET['id'];
  $activate_user= $object->activate_user($unique_id);
  $activate_user_decode = json_decode($activate_user, true);
  if($activate_user_decode['status']=='0'){
    echo json_encode(["status"=>"0", "message"=>"error_activating_user"]);
  }else{
    echo json_encode(["status"=>"1", "message"=>"success"]);
  }
?>