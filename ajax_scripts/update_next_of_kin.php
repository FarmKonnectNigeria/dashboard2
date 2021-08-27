<?php include('../includes/instantiated_files2.php');
    
	
	if( $_POST['nok_surname'] != "" && $_POST['nok_name'] != "" && $_POST['nok_phone'] != "" && $_POST['nok_email'] != ""
&& $_POST['contact_address'] != "" && $_POST['relationship'] != ""){
   
    $param = 'unique_id';
	$data = ['nok_surname', 'nok_name', 'nok_phone', 'nok_email', 'contact_address', 'relationship'];
	$notification_type = 'alert';
    $notification_heading = 'Next of Kin Details Update';
    $notification = 'You updated your next of kin details';
	$object = new DbQueries();
	$update_data =  $object->update_data('users_tbl',$data,$param,$uid);
	$update_decode = json_decode($update_data,true);
	if($update_decode['status'] === '0'){
		echo 500;
	}else{ 
     	echo 200;
     	 $object->insert_into_notifications_tbl($notification_type, $uid, $notification_heading, $notification);
     	 $object->insert_users_logs($_SESSION['uid'], "Updated Next of Kin's Details");	
	}
      } 
      else{

      	 echo 600;
      }

?>