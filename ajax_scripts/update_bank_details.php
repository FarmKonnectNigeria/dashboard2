<?php include('../includes/instantiated_files2.php');
    
   if( $_POST['bank_name'] != "" && $_POST['account_name'] != "" && $_POST['account_number'] != "" && $_POST['account_type'] != ""){
    $param = 'unique_id';
    $data = ['bank_name', 'account_name', 'account_number', 'account_type', 'bvn'];
    $notification_type = 'alert';
    $notification_heading = 'Bank Details Update';
    $notification = 'You updated your bank details';
    $object = new DbQueries();
    $update_data =  $object->update_data('users_tbl', $data,$param,$uid);
    $update_decode = json_decode($update_data,true);
    if($update_decode['status'] === '0'){
        echo 500;
    }else{ 
        echo 200;   
        $object->insert_into_notifications_tbl($notification_type, $uid, $notification_heading, $notification);
        $object->insert_users_logs($_SESSION['uid'], 'Updated Bank Details');
    }
   }else{
     echo 600;;
   }
?>
