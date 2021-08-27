<?php 
    session_start();
    require_once("../classes/db_class.php");
    require_once("../classes/algorithm_functions.php");
    require_once('db_connect.php');
    include("../includes/config.php");
    header('Content-Type: application/json');
    $object = new DbQueries;
    $investment_id = $_POST['investment_id'];
    $owner_id = $_POST['user_id'];
    $receiver_email = $_POST['receiver_email'];
    $get_receiver_id = $object->get_one_row_from_one_table('users_tbl','email',$receiver_email);
    if($get_receiver_id == null){
        echo json_encode(["status"=>"0", "msg"=>"User does not exist"]);
    }
    else{
        $receiver_id = $get_receiver_id['unique_id'];
        $added_by = $owner_id;
        $notification_type = 'update';
        $notification_heading = 'Transfer of Investment Ownership';
        $notification = 'You requested for transfer of investment ownership. You will be notified when the request is approved';
        $send_transfer_of_ownership_request = send_transfer_of_ownership_request($owner_id, $receiver_id, $investment_id, $added_by);
        $decode = json_decode($send_transfer_of_ownership_request,true);
        echo $send_transfer_of_ownership_request;
        if($decode['msg'] == "success"){
            $object->insert_into_notifications_tbl($notification_type, $owner_id, $notification_heading, $notification);
            $object->insert_users_logs($owner_id, 'Sent Transfer of Ownership Request');
        }
    }
?>