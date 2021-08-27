<?php session_start();
    require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    $object = new DbQueries();
    $unique_id = $_POST['uniqueid22'];
   
    $diapprove_subscription_request_military = $object->disapprove_subscription_request_military($unique_id);
    $dec = json_decode($diapprove_subscription_request_military,true);
    if($dec['status'] != 1){
        echo $dec['msg'];
    }else{
        echo 200;
        $row_get_military_det = $object->get_one_row_from_one_table('military_package_maker_checker','unique_id',$unique_id);
        $user_id = $row_get_military_det['user_id'];
          //$object->email_function($user_email, $subject, $content);
        $notification_type = 'alert';
        $notification_heading = 'Military Package Subscription';
        $notification = 'Hello, your military package subscription request was disapproved';
        $object->insert_logs($_SESSION['adminid'], 'Military Package Subscription Disapproval');
        $object->insert_into_notifications_tbl($notification_type, $user_id, $notification_heading, $notification);
        
    }
  
  

?>