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
	$table = 'access_card_tbl';
    $param = 'user_id';
    $value = $_GET['uid'];
    $new_value_param = 'card_status';
    $new_value = 1;
    $get_email = $object->get_one_row_from_one_table('users_tbl','unique_id',$value);
    $email = $get_email['email'];
    $subject = "Access Card Deactivation - FarmKonnect";
    $content = "You have successfully deactivated your access card. Please note, you can also reactivate the card
    Thanks, Regards";
    $notification_type = 'alert';
    $notification_heading = 'Access Card Reactivation';
    $notification = 'You reactivated your Access Card';
    $update_card_status = $object->update_with_one_param($table,$param,$value,$new_value_param,$new_value);
    $update_card_status_decode = json_decode($update_card_status, true);
    echo json_encode(["status"=>$update_card_status_decode['status'], "msg"=>$update_card_status_decode['msg']]);
    if($update_card_status_decode['status']== 1){
        $email_message = $object->email_function($email, $subject, $content);
        $object->insert_into_notifications_tbl($notification_type, $_GET['uid'], $notification_heading, $notification);
        $object->insert_users_logs($_GET['uid'], 'Reactivated Access Card');
    }
}
?>