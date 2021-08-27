<?php 
session_start();
require_once("../classes/db_class.php");
require_once('db_connect.php');
include("../includes/config.php");
header('Content-Type: application/json');
$object = new DbQueries;
$uid = $_GET['uid'];
if(!isset($uid)){
    echo json_encode(["status"=> "0", "msg"=> "empty_field(s)"]);
}else{
    $get_user = $object->get_one_row_from_one_table('users_tbl','unique_id', $uid);
    $user_email = $get_user['email'];
    $referral_link = "https://$_SERVER[HTTP_HOST]"."/signup?ref=".$user_email;
    echo json_encode(["status"=> "1", "msg"=> $referral_link]);
}
?>