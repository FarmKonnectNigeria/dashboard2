<?php 
session_start();
require_once("../classes/db_class.php");
require_once('db_connect.php');
include("../includes/config.php");
include("api_auth.php");
header('Content-Type: application/json');
$object = new DbQueries;
if(!isset($_GET['uid'])){
	echo json_encode(["status"=>"0", "msg"=>"empty_field"]);
}
else{
	$uid = $_GET['uid'];
	$get_email = $object->get_one_row_from_one_table('users_tbl','unique_id',$uid);
	$email = $get_email['email'];
    $subject = "Access Card Request - FarmKonnect";
    $content = "You have placed a request for your access card, please note that the processing may take up to 48 hours please kindly bear with us.
    Thanks, Regards";
    $notification_type = 'alert';
    $notification_heading = 'Access Card Request';
    $notification = 'You placed a request for your access card';
    $insert_request = $object->insert_into_access_tbl($uid);
    $insert_request_decode = json_decode($insert_request, true);
    echo json_encode(["status"=>$insert_request_decode['status'], "msg"=>$insert_request_decode['msg']]);
    if($insert_request_decode['msg'] == 'success'){
        $object->email_function($email, $subject, $content);
        $object->insert_into_notifications_tbl($notification_type, $uid, $notification_heading, $notification);
    }
}
?>